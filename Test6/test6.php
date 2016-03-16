<?php
/**
 * Created by JetBrains PhpStorm.
 * Test Proline AS
 * Class Proline
 * Author:Eugene Shkurnikov
  */
class Proline
{
    var $url = "";
    var $year = 0;

    /**
     * Constructor
     * Setup variables $url(remote file) and $year(season)
     * input $url,$year (local file absolute path)
     */
    function __construct($url, $year)
    {
        $this->url = $url;
        $this->year = $year;
    }

    /**
     * Function getInfo()
     * Return information about storms in definately season with maximum wind speed
     */
    function getInfo()
    {
        $arr = $this->createArray($this->downloadFile($this->url));
        //$arr = $this->createArray(getcwd() . "/hurdat2-nencpac-1949-2012-040513.txt");

        return $this->getStorms($arr);
    }

    /**
     * Function createArray()
     * Create array from txt file
     * input $path (local file absolute path)
     * output $arr (array from txt file)
     */
    function createArray($path)
    {
        $file = fopen($path, 'r');
        $name = "";
        $tmp_array_parent = array();
        $tmp_array_child = array();

        while (!feof($file)) {
            $tmp_str = fgets($file);
            if (strlen($tmp_str) == 38) { //If header
                if (isset($code) && isset($year)) {
                    if ($year === $this->year) {
                        if ($code === 'EP')
                            $tmp_array_parent[] = array('Northeast Pacific, ' . $name, $tmp_array_child);
                        else
                            $tmp_array_parent[] = array('North Central Pacific, ' . $name, $tmp_array_child);
                        $tmp_array_child = array();
                    }
                }
                $header_arr = explode(',', $tmp_str);
                $code = substr($header_arr[0], 0, 2);
                $year = intval(substr($header_arr[0], 4));
                $name = $header_arr[1];
            } else { //If data
                if (isset($year))
                    if ($year === $this->year)
                        $tmp_array_child[] = explode(',', $tmp_str);
            }
        }
        fclose($file);
        return $tmp_array_parent;
    }

    /**
     * Function downloadFile
     * Get contents from remote server and save localy
     * input $url
     * output $path (local file name (absolute path))
     */
    function downloadFile()
    {

        $i = strripos($this->url, "/");
        $str = substr($this->url, $i);
        $path = getcwd() . "/" . $str;


        if (file_exists($path)) {
            unlink($path);
        }
        $sourcetxt = $this->get_url_contents($this->url);
        $file = fopen($path, 'w');
        fwrite($file, $sourcetxt);
        fclose($file);

        return $path;
    }

    /**
     * Function get_url_contents()
     * Get contents from remote server
     * Use curl lib
     * input $url
     * output $ret (contents)
     */
    function get_url_contents()
    {
        $crl = curl_init();

        curl_setopt($crl, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)');
        curl_setopt($crl, CURLOPT_URL, $this->url);
        curl_setopt($crl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($crl, CURLOPT_CONNECTTIMEOUT, 5);

        $ret = curl_exec($crl);
        curl_close($crl);
        return $ret;
    }

    /**
     * Function getStorms()
     * Get storms from definately season with maximum wind speed
     * input $arr with data from txt file
     * output $str (storm type,storm name, maximum wind speed)
     */
    function getStorms($arr)
    {
        $str = "";
        foreach ($arr as $parr) {
            $name = $parr[0];
            $str = $str . $name . "; ";
            foreach ($parr as $carr)
                if ($this->getMaximumWindSpeed($carr) > 0)
                    $str = $str . "max wind speed=" . $this->getMaximumWindSpeed($carr) . "<br/>";
        }
        return $str;
    }

    /**
     * Function getMaximumWindSpeed($arr)
     * Get storms from definately season with maximum wind speed
     * input $arr
     * output $max (maximum wind speed)
     */
    function getMaximumWindSpeed($arr)
    {
        $max = 0;
        if (isset($arr) && count($arr) > 0) {
            foreach ($arr as $line)
                if (intval($line[6], 0) > $max)
                    $max = intval($line[6]);
        }
        return $max;
    }
}


$year = 2009;
$url = 'http://www.nhc.noaa.gov/data/hurdat/hurdat2-nencpac-1949-2012-040513.txt';
$proline = new Proline($url, $year);
echo "Needed storms 2009 season:<br/>" . $proline->getInfo();

