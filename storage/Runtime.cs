using UnityEngine;
using System.Collections;
using UnityEngine.UI;
using System;
using System.Collections.Generic;

public class Runtime : MonoBehaviour
{
    private static readonly Dictionary<String, String> REVMOB_APP_IDS = new Dictionary<String, String>() {
        { "Android", "561eba1696ab5cd467c65c8e"},
        { "IOS", "5609237c1fae625340e06b39" }
    };
    private RevMob revmob;

    void Awake()
    {
        revmob = RevMob.Start(REVMOB_APP_IDS, "Your GameObject name");
    }




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
    private float achWidth0;
    private float achWidth0real;
    public RectTransform achLine1;
    private float achWidth1;
    private float achWidth1real;
    public RectTransform achLine2;
    private float achWidth2;
    private float achWidth2real;
    private int pickaxeLevel;
    private double maxcoins;
    private int resetTaps;
    private double globalMulti;

    // Use this for initialization
    void Start()
    {


        PlayerPrefs.DeleteAll();


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
        maxcoins = 0;

        Load();

        calculateRank();
        InvokeRepeating("Save", 20f, 20f);
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
        btnLeftText.text = "<size=18>Rank Reset</size>\nDelete your progress to obtain a multiplier.\nCurrent multiplier: x" + Scala(globalMulti) + "\nNext multiplier: x" + Scala(GetResetBonus()) + "\n(tap " + resetTaps + " times to reset)";



        LoopRealTime();

        SmoothBars();
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
            Save();
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
            Save();
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
        achWidth1 = 25 + 275 * (float)ratio;
        //achLine1.sizeDelta = new Vector2(25 + 275 * (float)ratio, 1);

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
        achWidth2 = 25 + 275 * (float)ratio;
        //achLine2.sizeDelta = new Vector2(25 + 275 * (float)ratio, 1);

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
        achWidth0 = 25 + 275 * (float)ratio;
        //achLine0.sizeDelta = new Vector2(25 + 275 * (float)ratio, 1);


        if (rank > 999) rank = 999;


        rankText.text = rank.ToString();
    }
    void SmoothBars()
    {
        if (achWidth0real < achWidth0)
        {
            achWidth0real += 1f;
        }
        else if (achWidth0real > achWidth0)
        {
            if (achWidth0real - achWidth0 < 4)
                achWidth0real = achWidth0;
            else
                achWidth0real -= 4f;
        }
        achLine0.sizeDelta = new Vector2(achWidth0real, 1);

        if (achWidth1real < achWidth1)
        {
            achWidth1real += 1f;
        }
        else if (achWidth1real > achWidth1)
        {
            if (achWidth1real - achWidth1 < 4)
                achWidth1real = achWidth1;
            else
                achWidth1real -= 4f;
        }
        achLine1.sizeDelta = new Vector2(achWidth1real, 1);

        if (achWidth2real < achWidth2)
        {
            achWidth2real += 1f;
        }
        else if (achWidth2real > achWidth2)
        {
            if (achWidth2real - achWidth2 < 4)
                achWidth2real = achWidth2;
            else
                achWidth2real -= 4f;
        }
        achLine2.sizeDelta = new Vector2(achWidth2real, 1);
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
            Save();
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







    void Load()
    {
        coins = GetDouble("coins", 0);
        sf_levels[0] = PlayerPrefs.GetInt("sf_level0", 0);
        sf_levels[1] = PlayerPrefs.GetInt("sf_level1", 0);
        sf_levels[2] = PlayerPrefs.GetInt("sf_level2", 0);
        sf_levels[3] = PlayerPrefs.GetInt("sf_level3", 0);
        sf_levels[4] = PlayerPrefs.GetInt("sf_level4", 0);
        sf_levels[5] = PlayerPrefs.GetInt("sf_level5", 0);
        sf_levels[6] = PlayerPrefs.GetInt("sf_level6", 0);
        sf_levels[7] = PlayerPrefs.GetInt("sf_level7", 0);
        selected = PlayerPrefs.GetInt("selected", -1);
        mountainLevel = PlayerPrefs.GetInt("mountainLevel", 1);
        taps = PlayerPrefs.GetInt("taps", 0);
        totalProfit = GetDouble("totalProfit", 0);
        upgrades = PlayerPrefs.GetInt("upgrades", 0);
        pickaxeLevel = PlayerPrefs.GetInt("pickaxeLevel", 1);
        resetTaps = PlayerPrefs.GetInt("resetTaps", 10);
        globalMulti = GetDouble("globalMulti", 1);
        maxcoins = GetDouble("maxcoins", 0);

    }
    void Save()
    {
        RevMobBanner banner = revmob.CreateBanner();
        banner.Show();
        SetDouble("coins", coins);
        PlayerPrefs.SetInt("sf_level0", sf_levels[0]);
        PlayerPrefs.SetInt("sf_level1", sf_levels[1]);
        PlayerPrefs.SetInt("sf_level2", sf_levels[2]);
        PlayerPrefs.SetInt("sf_level3", sf_levels[3]);
        PlayerPrefs.SetInt("sf_level4", sf_levels[4]);
        PlayerPrefs.SetInt("sf_level5", sf_levels[5]);
        PlayerPrefs.SetInt("sf_level6", sf_levels[6]);
        PlayerPrefs.SetInt("sf_level7", sf_levels[7]);
        PlayerPrefs.SetInt("selected", selected);
        PlayerPrefs.SetInt("mountainLevel", mountainLevel);
        PlayerPrefs.SetInt("taps", taps);
        SetDouble("totalProfit", totalProfit);
        PlayerPrefs.SetInt("upgrades", upgrades);
        PlayerPrefs.SetInt("pickaxeLevel", pickaxeLevel);
        PlayerPrefs.SetInt("resetTaps", resetTaps);
        SetDouble("globalMulti", globalMulti);
        SetDouble("maxcoins", maxcoins);
    }


    //saving stuff
    public static void SetDouble(string key, double value)
    {
        PlayerPrefs.SetString(key, DoubleToString(value));
    }
    public static double GetDouble(string key, double defaultValue)
    {
        string defaultVal = DoubleToString(defaultValue);
        return StringToDouble(PlayerPrefs.GetString(key, defaultVal));
    }
    public static double GetDouble(string key)
    {
        return GetDouble(key, 0d);
    }

    private static string DoubleToString(double target)
    {
        return target.ToString("R");
    }
    private static double StringToDouble(string target)
    {
        if (string.IsNullOrEmpty(target))
            return 0d;
        return double.Parse(target);
    }






















}
