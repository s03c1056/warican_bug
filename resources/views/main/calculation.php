<?php

$totalPrice = 94745;     //飲み会の合計金額
$drankParson = 2;        //お酒を飲んだ人
$noDrankParson = 6;      //お酒を飲んでない人

$drankAdjustedPrice = 0;        //調整した一人当たりの金額(お酒を飲んだ人)
$noDrankAdjustedPrice = 0;      //調整した一人当たりの金額(お酒を飲んでない人)
$adjustedPrice = 0;             //調整した一人当たりの金額(全員飲んでるor全員飲んでない)
$change = 0;                    //おつり



//参加人数を計算
$people = $drankParson + $noDrankParson;

//合計金額から参加人数を割る
$basicPrice = $totalPrice / $people;


//お酒を飲まない人がいるかいないかで条件分岐
if ($noDrankParson > 0 && $drankParson > 0) {

  //お酒を飲む人と飲まない人どっちが多いかで条件分岐
  if ($drankParson >= $noDrankParson) {

    //飲んでない人の一人当たりの金額を90％の金額にする
    $noDrankAdjustedPrice = $basicPrice * 0.9;
    
    //飲んだ人の合計金額を算出
    $drankPeopleTotal = $totalPrice - ($noDrankAdjustedPrice * $noDrankParson);

    //飲んだ人の一人当たりの金額を算出
    $drankAdjustedPrice = $drankPeopleTotal / $drankParson;

    //飲んでない人の金額を10の位で四捨五入
    $roundAdjustment = round($noDrankAdjustedPrice, -2);

    //四捨五入した金額が基本の一人当たりの金額よりも少ない場合、100を足して調整
    if ($roundAdjustment >= $noDrankAdjustedPrice) {
      $noDrankAdjustedPrice = $roundAdjustment;
    } else {
      $noDrankAdjustedPrice = $roundAdjustment + 100;
    }
    
    //飲んだ人の金額を100の位で四捨五入
    $roundAdjustment = round($drankAdjustedPrice, -2);

    //四捨五入した金額が基本の一人当たりの金額よりも少ない場合、100を足して調整
    if ($roundAdjustment >= $drankAdjustedPrice) {
      $drankAdjustedPrice = $roundAdjustment;
    } else {
      $drankAdjustedPrice = $roundAdjustment + 100;
    }
    
    //おつりを算出
    $adjustedTotalPrice = $drankAdjustedPrice * $drankParson
    + $noDrankAdjustedPrice * $noDrankParson;

    $change = $adjustedTotalPrice - $totalPrice;


  } else {

    //飲んだ人の一人当たりの金額を110％の金額にする
    $drankAdjustedPrice = $basicPrice * 1.1;
    
    //飲んでない人の合計金額を算出
    $noDrankPeopleTotal = $totalPrice - ($drankAdjustedPrice * $drankParson);

    //飲んでない人の一人当たりの金額を算出
    $noDrankAdjustedPrice = $noDrankPeopleTotal / $noDrankParson;

    //飲んでない人の金額を100の位で四捨五入
    $roundAdjustment = round($noDrankAdjustedPrice, -2);

    //四捨五入した金額が基本の一人当たりの金額よりも少ない場合、100を足して調整
    if ($roundAdjustment >= $noDrankAdjustedPrice) {
      $noDrankAdjustedPrice = $roundAdjustment;
    } else {
      $noDrankAdjustedPrice = $roundAdjustment + 100;
    }
    
    //飲んだ人の金額を100の位で四捨五入
    $roundAdjustment = round($drankAdjustedPrice, -2);

    //四捨五入した金額が基本の一人当たりの金額よりも少ない場合、100を足して調整
    if ($roundAdjustment >= $drankAdjustedPrice) {
      $drankAdjustedPrice = $roundAdjustment;
    } else {
      $drankAdjustedPrice = $roundAdjustment + 100;
    }
    
    //おつりを算出
    $adjustedTotalPrice = $drankAdjustedPrice * $drankParson
    + $noDrankAdjustedPrice * $noDrankParson;

    $change = $adjustedTotalPrice - $totalPrice;

  }

} else {

  //一人当たりの金額を100の位で四捨五入
  $roundAdjustment = round($basicPrice, -2);

  //四捨五入した金額が基本の一人当たりの金額よりも少ない場合、100を足して調整
  if ($roundAdjustment >= $basicPrice) {
    $adjustedPrice = $roundAdjustment;
  } else {
    $adjustedPrice = $roundAdjustment + 100;
  }

  //おつりを算出
  $adjustedTotalPrice = $adjustedPrice * $people;
  $change = $adjustedTotalPrice - $totalPrice;
  
}

  echo "飲んでない人の金額を100の位で四捨五入=".$noDrankAdjustedPrice;
  echo "<br>";
  
  echo "飲んだ人の金額を100の位で四捨五入=".$drankAdjustedPrice;
  echo "<br>";

  echo "全員飲んだor全員飲んでない時の金額を100の位で四捨五入=".$adjustedPrice;
  echo "<br>";

  echo "おつりを算出=".$change;
  echo "<br>";
