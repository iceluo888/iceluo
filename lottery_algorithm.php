<?php
/**
 * [抽奖算法，可以自定义奖项和概率]
 * @param 
 * @return 
 */
function get_rand($proArr) {
    $result = '';
   
    //概率数组的总概率精度  数组的值的总和（这里是100）
    $proSum = array_sum($proArr);
   
    //概率数组循环
    foreach ($proArr as $key => $proCur) {
     // 取一个1~100的随机数
        $randNum = mt_rand(1, $proSum);
        // 如果 数 小于等于 当前的中奖概率数中 则出结果
        if ($randNum <= $proCur) {
            $result = $key;
            break;
        } else {
           // 如果大于中奖概率数，则将总和减少当前中奖概率的数目
            $proSum -= $proCur;
        }
    }
    unset ($proArr);
   
    return $result;
}

$prize_arr = array(
    '0' => array('id'=>1,'prize'=>'1Q币','v'=>20),
    '1' => array('id'=>2,'prize'=>'2Q币','v'=>15),
    '2' => array('id'=>3,'prize'=>'10Q币','v'=>5),
    '3' => array('id'=>4,'prize'=>'20Q币','v'=>5),
    '4' => array('id'=>5,'prize'=>'50Q币','v'=>5),
    '5' => array('id'=>6,'prize'=>'很遗憾，没有中奖','v'=>50),
);

foreach ($prize_arr as $key => $val) {
    $arr[$val['id']] = $val['v'];
}

$rid = get_rand($arr); //根据概率获取奖项id

$res['yes'] = $prize_arr[$rid-1]['prize']; //中奖项

unset($prize_arr[$rid-1]); //将中奖项从数组中剔除，剩下未中奖项

shuffle($prize_arr); //打乱数组顺序

for($i=0;$i<count($prize_arr);$i++){
    $pr[] = $prize_arr[$i]['prize'];
}

$res['no'] = $pr;

// 传递到前端
echo json_encode($res);