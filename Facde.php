/**
 * Class YzjInstance
 * @package app\common\service\getYZJData
 * @method ScanCode scanCodeList(array $arguments) static 
 * @method ScanCode inpaScanCodeList(array $arguments) static 
 * @method ScanCode hourseScanCodeList(array $arguments) static 
 * @method FunctionalInspec functionalInspecList(array $arguments) static 
 * @method FunctionalInspec functionalInspecInfo(array $arguments) static 
 * @method CleanTask cleanTaskList(array $arguments) static 
 * @method DailyTask dailyTaskList(array $arguments) static 
 * @method DailyTask dailyTaskInfo(array $arguments) static 
 * @method Quality qualityList(array $arguments) static 
 * @method Quality qualityInfo(array $arguments) static 
 * @method HomeStatis homeStatisIndex(array $arguments) static 
 */
class YzjInstance
{

    //类实例
    private static $singleInstance = [];

    //类、方法
    private static $classMethod = [
        'scanCodeList' => 'ScanCode', 
        'inpaScanCodeList' => 'ScanCode',
        'hourseScanCodeList' => 'ScanCode', 
        'functionalInspecList' => 'FunctionalInspec',
        'functionalInspecInfo' => 'FunctionalInspec', 
        'cleanTaskList' => 'CleanTask', 
        'dailyTaskList' => 'DailyTask', 
        'dailyTaskInfo' => 'DailyTask', 
        'qualityList' => 'Quality', 
        'qualityInfo' => 'Quality', 
        'homeStatisIndex' => 'HomeStatis',
    ];

    /**
     * 调用类的方法
     * @param string $method 方法名
     * @param array $arguments 参数
     * @return int|mixed
     */
    public static function __callStatic($method, $arguments)
    {
        //验证权限
//        $checkAuth = self::checkAuth();
//        if ($checkAuth) return $checkAuth;

        //获取实例
        $namespaceString = self::getInstance($method);
        if (is_numeric($namespaceString)) return$namespaceString;

        return call_user_func_array([$namespaceString, $method], $arguments);
    }

    private static function checkAuth()
    {
    }

    /**
     * @param $method
     * @return int|mixed
     */
    private static function getInstance($method)
    {
        if (!isset(self::$singleInstance[$method]))
        {
            $classString = array_key_exists($method, self::$classMethod)
                ? self::$classMethod[$method]
                : 10020;
            if (is_numeric($classString)) return $classString;

            $namespaceString = '\\app\\common\\service\\getYZJData\\' . $classString;

            self::$singleInstance[$method] = new $namespaceString;
        }

        return self::$singleInstance[$method];
    }


}
