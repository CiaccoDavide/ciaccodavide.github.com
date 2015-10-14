using UnityEngine;
using System.Collections;
using UnityEngine.UI;
using System;

public class Runtime : MonoBehaviour
{

    private double coins;
    public Text coins_text;
    public Image sf1;
    public Image sf2;
    public Image sf3;
    public Image sf4;
    public Image sf5;
    public Image sf6;
    public Image sf7;
    public Image sf8;
    private int[] sf_levels = new int[8];
    private Image[] sf = new Image[8];
    private Color tempcolor;
    public Text btnLeftText;
    public Text btnRightText;
    private int selected;
    private int mountainLevel;
    public Text stats;
    private int taps;
    private int upgrades;
    private double totalProfit;
    private int rank;
    public Text rankText;
    public RectTransform achLine0;
    public RectTransform achLine1;
    public RectTransform achLine2;
    private int pickaxeLevel;
    private double maxcoins;
    private int resetTaps;
    private double globalMulti;
    private float deltaTime = 0;

    // Use this for initialization
    void Start()
    {
        coins = 0;
        //InvokeRepeating("Loop", 0.2f, 0.1f);
        InvokeRepeating("LongLoop", 1f, 2f);
        sf_levels[0] = 0;
        sf_levels[1] = 0;
        sf_levels[2] = 0;
        sf_levels[3] = 0;
        sf_levels[4] = 0;
        sf_levels[5] = 0;
        sf_levels[6] = 0;
        sf_levels[7] = 0;
        sf[0] = sf1;
        sf[1] = sf2;
        sf[2] = sf3;
        sf[3] = sf4;
        sf[4] = sf5;
        sf[5] = sf6;
        sf[6] = sf7;
        sf[7] = sf8;
        //the mountain is selected
        selected = -1;
        mountainLevel = 1;
        taps = 0;
        totalProfit = 0;
        upgrades = 0;
        rank = 0;
        pickaxeLevel = 1;
        resetTaps = 10;
        globalMulti = 1;

        calculateRank();
    }

    // Update is called once per frame
    void Update()
    {
        if (maxcoins < coins) maxcoins = coins;
        coins_text.text = ScalaD(coins);
        for (int i = 0; i < 8; i++)
        {
            if (sf_levels[i] == 0)
            {
                tempcolor = sf[i].color;
                tempcolor.a = 0.3f;
                sf[i].color = tempcolor;
            }
            else
            {
                tempcolor = sf[i].color;
                tempcolor.a = 1f;
                sf[i].color = tempcolor;
            }
        }
        stats.text = "" + Scala(Profit()) + "/s\n" + Scala(ProfitMountain()) + "\n" + Scala(taps) + "\n" + Scala(totalProfit) + "\n" + Scala(maxcoins) + "\n" + Scala(upgrades);

        if (resetTaps < 1)
        {
            Reset();
        }
        btnLeftText.text = "<size=18>Rank Reset</size>\nDelete your progress to obtain a multiplier.\nCurrent multiplier: x"+Scala(globalMulti)+"\nNext multiplier: x" + Scala(GetResetBonus()) + "\n(tap " + resetTaps + " times to reset)";



        LoopRealTime();
    }

    public void TapOnMountain()
    {
        taps++;
        coins += ProfitMountain();
        totalProfit += ProfitMountain();
        selected = 0;
        btnRightText.text = "<size=18>Upgrade the Mountain</size>\nLVL " + mountainLevel + "\n<color=#eeeeee>Upgrade cost: " + Scala(CostMountain()) + "\nProfit: " + Scala(ProfitMountain()) + "/tap\nNext lvl profit: " + Scala(ProfitMountainNext()) + "/tap</color>";
    }

    double ProfitMountain()
    {
        return Math.Pow(4, mountainLevel - 1) * pickaxeLevel * globalMulti;
    }
    double ProfitMountainNext()
    {
        return Math.Pow(4, mountainLevel) * pickaxeLevel * globalMulti;
    }
    double CostMountain()
    {
        return 100 * Math.Pow(4.2, mountainLevel - 1);
    }


    public void TapOnSf(int i)
    {
        selected = i;
        btnRightText.text = "<size=18>Auto-pickaxe #" + i + "</size>\nLVL " + sf_levels[i - 1] + "\n<color=#eeeeee>Upgrade cost: " + Scala(CostSf(i - 1)) + "\nProfit: " + Scala(ProfitSf(i - 1)) + "/s\nNext level profit: " + Scala(ProfitSfNextLvl(i - 1)) + "/s</color>";
    }
    void Loop()
    {
        coins += Profit() / 10f;
        totalProfit += Profit() / 10f;
        calculateRank();
    }



    void LoopRealTime()
    {
        

        coins += Profit() * Time.deltaTime;
        totalProfit += Profit() * Time.deltaTime;
        calculateRank();
    }



    double Profit()
    {
        double profit = 0;
        for (int i = 0; i < 8; i++)
            if (sf_levels[i] > 0)
                profit += ProfitSf(i);
        return profit;
    }
    double ProfitSf(int i)
    {
        return Math.Pow(2, sf_levels[i] - 1) * (1 + 0.1 * (mountainLevel - 1)) * globalMulti;
    }
    double ProfitSfNextLvl(int i)
    {
        return Math.Pow(2, sf_levels[i]) * (1 + 0.1 * (mountainLevel - 1)) * globalMulti;
    }

    double CostSf(int i)
    {
        Double costo = 0;
        for (int n = 0; n < 8; n++) if (sf_levels[n] > 0) costo += 1;
        costo *= 10 * Math.Pow(2, sf_levels[i]);
        return costo;
    }


    public void TapRightButton()
    {
        switch (selected)
        {
            case -1: break;
            case 0: UpgradeMountain(); break;
            default: UpgradeSf(selected - 1); break;
        }
    }

    void UpgradeMountain()
    {
        if (coins >= CostMountain())
        {
            coins -= CostMountain();
            mountainLevel++;
            TapOnMountain();
            upgrades++;
        }
    }
    void UpgradeSf(int i)
    {
        if (coins >= CostSf(i))
        {
            coins -= CostSf(i);
            sf_levels[i]++;
            TapOnSf(i + 1);
            upgrades++;
        }
    }



    void calculateRank()
    {
        rank = 0;
        double limit = 10;
        double tempStat = totalProfit;
        double ratio = 0;
        while (tempStat >= limit)
        {
            tempStat -= limit;
            limit *= 2;
            rank++;
        }
        ratio = tempStat / limit;
        achLine1.sizeDelta = new Vector2(25 + 275 * (float)ratio, 1);

        limit = 10;
        tempStat = maxcoins;
        ratio = 0;
        while (tempStat >= limit)
        {
            tempStat -= limit;
            limit *= 2;
            rank++;
        }
        ratio = tempStat / limit;
        achLine2.sizeDelta = new Vector2(25 + 275 * (float)ratio, 1);

        limit = 10;
        tempStat = taps;
        ratio = 0;
        while (tempStat >= limit)
        {
            tempStat -= limit;
            limit *= 2;
            rank++;
        }
        ratio = tempStat / limit;
        achLine0.sizeDelta = new Vector2(25 + 275 * (float)ratio, 1);


        if (rank > 999) rank = 999;


        rankText.text = rank.ToString();
    }


    string Scala(double num)
    {
        if (num < 1e3) return "" + pDD(num);
        else if (num >= 1e48) return pDD(num / 1e48) + " EventsHorizon";
        else if (num >= 1e45) return pDD(num / 1e45) + " Quadridecillions";
        else if (num >= 1e42) return pDD(num / 1e42) + " Tridecillions";
        else if (num >= 1e39) return pDD(num / 1e39) + " Duodecillions";
        else if (num >= 1e36) return pDD(num / 1e36) + " Undecillions";
        else if (num >= 1e33) return pDD(num / 1e33) + " Decillions";
        else if (num >= 1e30) return pDD(num / 1e30) + " Nonillions";
        else if (num >= 1e27) return pDD(num / 1e27) + " Octillions";
        else if (num >= 1e24) return pDD(num / 1e24) + " Septillions";
        else if (num >= 1e21) return pDD(num / 1e21) + " Sextillions";
        else if (num >= 1e18) return pDD(num / 1e18) + " Quintillions";
        else if (num >= 1e15) return pDD(num / 1e15) + " Quadrillions";
        else if (num >= 1e12) return pDD(num / 1e12) + " T";
        else if (num >= 1e9) return pDD(num / 1e9) + " B";
        else if (num >= 1e6) return pDD(num / 1e6) + " M";
        else if (num >= 1e3) return pDD(num / 1e3) + " K";
        return null;
    }
    string ScalaD(double num)
    {
        if (num == 0) return "0";
        else if (num < 1e3) return "" + pDD(num).ToString("0.00");
        else if (num >= 1e48) return pDD(num / 1e48).ToString("0.00") + " EventsHorizon";
        else if (num >= 1e45) return pDD(num / 1e45).ToString("0.00") + " Quadridecillions";
        else if (num >= 1e42) return pDD(num / 1e42).ToString("0.00") + " Tridecillions";
        else if (num >= 1e39) return pDD(num / 1e39).ToString("0.00") + " Duodecillions";
        else if (num >= 1e36) return pDD(num / 1e36).ToString("0.00") + " Undecillions";
        else if (num >= 1e33) return pDD(num / 1e33).ToString("0.00") + " Decillions";
        else if (num >= 1e30) return pDD(num / 1e30).ToString("0.00") + " Nonillions";
        else if (num >= 1e27) return pDD(num / 1e27).ToString("0.00") + " Octillions";
        else if (num >= 1e24) return pDD(num / 1e24).ToString("0.00") + " Septillions";
        else if (num >= 1e21) return pDD(num / 1e21).ToString("0.00") + " Sextillions";
        else if (num >= 1e18) return pDD(num / 1e18).ToString("0.00") + " Quintillions";
        else if (num >= 1e15) return pDD(num / 1e15).ToString("0.00") + " Quadrillions";
        else if (num >= 1e12) return pDD(num / 1e12).ToString("0.00") + " T";
        else if (num >= 1e9) return pDD(num / 1e9).ToString("0.00") + " B";
        else if (num >= 1e6) return pDD(num / 1e6).ToString("0.00") + " M";
        else if (num >= 1e3) return pDD(num / 1e3).ToString("0.00") + " K";
        return null;
    }
    double pDD(double num) { return Math.Floor((100) * num) / 100; }






    void LongLoop()
    {
        if (resetTaps < 10)
        {
            resetTaps++;
        }
    }
    public void TapLeftButton()
    {
        resetTaps--;
    }
    void Reset()
    {
        if (rank > 29)
        {
            if (rank < 30)
                globalMulti = 1;
            else
                globalMulti = ((double)rank / 30d);
            coins = 0;
            sf_levels[0] = 0;
            sf_levels[1] = 0;
            sf_levels[2] = 0;
            sf_levels[3] = 0;
            sf_levels[4] = 0;
            sf_levels[5] = 0;
            sf_levels[6] = 0;
            sf_levels[7] = 0;
            sf[0] = sf1;
            sf[1] = sf2;
            sf[2] = sf3;
            sf[3] = sf4;
            sf[4] = sf5;
            sf[5] = sf6;
            sf[6] = sf7;
            sf[7] = sf8;
            selected = -1;
            mountainLevel = 1;
            taps = 0;
            totalProfit = 0;
            upgrades = 0;
            rank = 0;
            pickaxeLevel = 1;
            resetTaps = 10;
            btnRightText.text = "Select something\nto upgrade.";
        }
        else
        {
            resetTaps = 10;
        }
    }
    double GetResetBonus()
    {
        double bonus = ((double)rank / 30d);
        if (rank < 30) return 1;
        return bonus;
    }



}
