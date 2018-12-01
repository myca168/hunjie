<?php
require_once 'init168.php';

$ads=Model_YpCustomer::getAllAds();

if ($ads) {
 
	foreach ($ads as $yp) {
		$ypdate=time()-strtotime($yp->end_date);
		if ($yp->flag==2 && $ypdate>0 ) {
		$yp->flag=1;
		$yp->sqn=99;
		$yp->month=$yp->month+60;
		$yp->end_date=date('Y-m-d',strtotime("+60 month",strtotime($yp->end_date)));
		$yp->save();

		}
	}


}


$csAds=Model_ClassifiedsCustomer::getAllAds();

if ($csAds) {
	foreach ($csAds as $cs) {
		$csdate=time()-strtotime($cs->end_date);
		if ($cs->flag==2 && $csdate>0 ) {
		$cs->flag=1;
		$cs->sqn=99;
		$cs->week=$cs->week+10;
		$cs->end_date=date('Y-m-d',strtotime("+10 week",strtotime($cs->end_date)));
		$cs->save();
		
		}
	}
}

$carAds=Model_CarAds::getAllAds();

if ($carAds) {
	foreach ($carAds as $car) {
		$cardate=time()-strtotime($car->end_date);
		if ($car->flag==2 && $cardate>0 ) {
		$car->flag=1;
		$car->sqn=99;
		$car->week=$car->week+10;
		$car->end_date=date('Y-m-d',strtotime("+10 week",strtotime($car->end_date)));
		$car->save();
	
		}
	}
}

$jaAds=Model_JobAgent::getAllAds();

if ($jaAds) {
	foreach ($jaAds as $ja) {
		$jadate=time()-strtotime($ja->end_date);
		if ($ja->flag==2 && $jadate>0 ) {
		$ja->flag=1;
		$ja->sqn=99;
		$ja->month=$ja->month+60;
		$ja->end_date=date('Y-m-d',strtotime("+60 month",strtotime($ja->end_date)));
		$ja->save();
		}
	}
}

$jobAds=Model_JobEmployer::getAllAds();

if ($jobAds) {
	foreach ($jobAds as $job) {
		$jobdate=time()-strtotime($job->end_date);
		if ($job->flag==2 && $jobdate>0 ) {
		$job->flag=1;
		$job->sqn=99;
		$job->week=$job->week+10;
		$job->end_date=date('Y-m-d',strtotime("+10 week",strtotime($job->end_date)));
		$job->save();
	
		}
	}
}

$foodAds=Model_FoodRes::getAllAds();

if ($foodAds) {
	foreach ($foodAds as $food) {
		$fdate=time()-strtotime($food->end_date);
		if ($food->flag==2 && $fdate>0 ) {
		$food->flag=1;
		$food->sqn=99;
		$food->month=$food->month+60;
		$food->end_date=date('Y-m-d',strtotime("+60 month",strtotime($food->end_date)));
		$food->save();
		}
	}
}


/*   The following for real estate model */

$owners=Model_HouseOwner::getAllAds();

if ($owners) {
	foreach ($owners as $owner) {
		$odate=time()-strtotime($owner->end_date);
		if ($owner->flag==2 && $odate>0 ) {
		$owner->flag=1;
		$owner->sqn=99;
		$owner->month=$owner->month+60;
		$owner->end_date=date('Y-m-d',strtotime("+60 month",strtotime($owner->end_date)));
		$owner->save();
		}
	}
}

$projects=Model_HouseProject::getAllAds();

if ($projects) {
	foreach ($projects as $pro) {
		$prodate=time()-strtotime($pro->end_date);
		if ($pro->flag==2 && $prodate>0 ) {
		$pro->flag=1;
		$pro->sqn=99;
		$pro->month=$pro->month+60;
		$pro->end_date=date('Y-m-d',strtotime("+60 month",strtotime($pro->end_date)));
		$pro->save();
		}
	}
}

$coms=Model_HouseCommerceTrans::getAllAds();

if ($coms) {
	foreach ($coms as $com) {
		$cdate=time()-strtotime($com->end_date);
		if ($com->flag==2 && $cdate>0 ) {
		$com->flag=1;
		$com->sqn=99;
		$com->month=$com->month+60;
		$com->end_date=date('Y-m-d',strtotime("+60 month",strtotime($com->end_date)));
		$com->save();
		}
	}
}


$ha=Model_Agents::getAllAds();

if ($ha) {
	foreach ($ha as $hagent) {
		$hadate=time()-strtotime($hagent->end_date);
		if ($hagent->flag==2 && $hadate>0 ) {
		$vip=$hagent->viprow;	
		$hagent->flag=1;
		$hagent->sqn=99;
		$hagent->month=$hagent->month+60;
		$hagent->viprow=0;
		$hagent->end_date=date('Y-m-d',strtotime("+60 month",strtotime($hagent->end_date)));
		$hagent->save();
			if ($vip) {
			$house=Model_HouseSell::getAds($vip);
			$house->flag=1;
			$house->sqn=99;
			$house->month=$house->month+60;
			$house->end_date=date('Y-m-d',strtotime("+60 month",strtotime($house->end_date)));
			$house->save();
			}
		}
	}
}

$sellh=Model_HouseSell::getAllAds();

if ($sellh) {
	foreach ($sellh as $sale) {
		$hsdate=time()-strtotime($sale->end_date);
		if ($sale->flag==2 && $hsdate>0 ) {
		$sale->flag=1;
		$sale->sqn=99;
		$sale->month=$sale->month+60;
		$sale->end_date=date('Y-m-d',strtotime("+60 month",strtotime($sale->end_date)));
		$sale->save();
		}
	}
}

$msg="Daily Flags Reset Done - ".date('Y-m-d');
var_dump($msg);
