<?php
    $fileSourceURL = 'https://cdn.flashtalking.com/feeds/test_data/att_product_data.json';
    $tempFileSource = 'C:\xampp\htdocs\MARTIN_OLSON_ATT_ACTIVITY\att_product_data.json';
    $fileBaseName = basename($fileSourceURL);
    $fileContents = file_get_contents($tempFileSource);
    $fileForDisplay = json_decode($fileContents,true);

    //$header = false; //dont need this
    //$arrayToPassForCSVing = [];//probably dont need this here

?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    </head>
    <body>
        <div>
        <a href="https://cdn.flashtalking.com/feeds/test_data/att_product_data.json">File here</a>
        </div>
        <div>
            <?php
            foreach($fileForDisplay as $key => $value){
                if(!is_array($value))
                { 
                    //echo '<br>1D object index: ' . $key . '<br>';
                } else {
                        foreach($value as $sku => $skuEntry) 
                            {if (!is_array($skuEntry)) {echo 'You Should not be here';} 
                                else {  //this cuts the two 1d things (I presume they are unwanted and unloved)
                                        
                                    foreach($skuEntry as $singleSku => $skuEntryColumnHeading)
                                        {   $newSubTargetArray = [];
                                            //$filthyAppleDevice = false;
                                            //OKAY. so singleSku is the column heading ID. skuEntryColumnHeading is the data in each line, and some of these are still arrays
                                            if (!is_array($skuEntryColumnHeading))
                                            { 
                                                //echo '<br>2D column index: ' . $singleSku . '<br>';//all the data we need can be found here
                                                if ($singleSku == 'mBrand'){ // && brand !apple                                        
                                                    $tempmBrandArray = array('mBrand'=> $skuEntryColumnHeading);
                                                    if($skuEntryColumnHeading == "Apple"){
                                                        //$filthyAppleDevice = true;
                                                        //var_dump($filthyAppleDevice);
                                                        $tempmBrandArray = 'filthyAppleDevice';
                                                    }
                                                } if ($singleSku === 'skuDisplayName') {
                                                    $lastHyphenInSkuDisplayNameLoc = strrpos($skuEntryColumnHeading,'-',-1);
                                                    
                                                    $skuDisplayNameWithoutColour = substr($skuEntryColumnHeading,0,$lastHyphenInSkuDisplayNameLoc);
                                                    
                                                    $tempSkuDisplayNameArray = array('skuDisplayName' => $skuDisplayNameWithoutColour);   

                                                } if ($singleSku == 'mPrice') {
                                                    //echo "this is an mprice";

                                                    $tempMPriceArray = array('mPrice' => $skuEntryColumnHeading);

                                                } if ($singleSku == 'mListPrice') {
                                                    //echo "this is an mlisprice";

                                                    $tempMListPriceArray = array('mListPrice' => $skuEntryColumnHeading);

                                                } if ($singleSku == 'mModel'){
                                                    //echo 'this is the model';

                                                    $tempMModelArray = array('mModel'=> $skuEntryColumnHeading);
                                                    
                                                } if ($singleSku =='mLargeImage'){
                                                    //echo 'this is the image';

                                                    $tempMLargeImageArray = array('mLargeImage'=> $skuEntryColumnHeading);

                                                } if ($singleSku == 'mId'){
                                                    //echo 'this is the mid';

                                                    $tempMIdArray = array('mId'=> $skuEntryColumnHeading);
                                                   
                                                } if ($singleSku == 'mProductPageURL'){
                                                   // echo 'mproductpageurl is this';

                                                    $tempProductPageURLArray = array('mProductPageURL'=> $skuEntryColumnHeading);                  

                                                } if ($singleSku == 'mName') {
                                                   // echo 'this is the mname';

                                                    $tempmNameArray = array('mName'=> $skuEntryColumnHeading);
                                                    
                                                } if ($singleSku == 'salesRank') {
                                                    //echo 'this is the salesrank';
                                                    //so I just realised this should totally be a function
                                                    $tempSalesRankArray = array('salesRank'=>$skuEntryColumnHeading);
                                                    
                                                } if ($singleSku == 'mStarRatings'){
                                                    // "this is the mstarrating";

                                                    $tempmStarRatingsArray = array('mStarRatings'=> $skuEntryColumnHeading);                                                 

                                                } if ($singleSku == 'mProductId') {
                                                    //echo 'this is hte mproductid';

                                                    $tempmProductIdArray = array('mProductId'=> $skuEntryColumnHeading);                                                  

                                                } if ($singleSku == 'deviceType'){
                                                    //echo 'this is the devicetype';
                                                    
                                                    $tempDeviceTypeArray = array('deviceType'=> $skuEntryColumnHeading);
                                                    
                                                } if ($singleSku == 'mMobileProductPageURL'){
                                                    //echo 'this is the mobile product page url';

                                                    $tempmobileProductPageurlArray = array('mMobileProductPageURL'=> $skuEntryColumnHeading);
                                                    
                                                } if ($singleSku == 'mProductPageURLEs') {
                                                    //echo 'this is the product page urles';

                                                    $tempmProductPageURLEs = array('mProductPageURLEs'=> $skuEntryColumnHeading);    

                                                } if ($singleSku == 'mDescription'){
                                                    //echo 'this is the mdescription';

                                                    $tempMDescriptionArray = array('mDescription'=> $skuEntryColumnHeading);   

                                                } if ($singleSku == 'mDueToday'){
                                                    //echo ' this is the mduetoday';

                                                    $tempMDueTodayArray = array('mDueToday'=> $skuEntryColumnHeading);

                                                } if ($singleSku == 'PDPPageURL'){
                                                    //echo 'this is the pdppageurl';

                                                    $tempPDPPageURLArray = array('PDPPageURL'=>$skuEntryColumnHeading);
                                                    
                                                    //so this is the array with all the things, however, it is not limited by
                                                } 
                                                
                                                else {
                                                   // echo 'dont want this';
                                                }          
                                            } else 
                                                {   //$searchCatFor = "M-CAT-SMARTPHONES";
                                                    
                                                    if(array_search("M-CAT-SMARTPHONES",$skuEntryColumnHeading,true)){
                                                        //var_dump($skuEntryColumnHeading);
                                                        //echo '<br><br>';
                                                        $tempSmartPhoneToggle = 'smartphone';
                                                        //echo $tempSmartPhoneToggle . '  ';
                                                        //echo $singleSku . '<br>';
                                                        //var_dump($skuEntryColumnHeading);
                                                
                                                        //echo '<br><br>';
                                                        
                                                    } if (array_search("M-CAT-TABLETS",$skuEntryColumnHeading,true)){
                                                        $tempSmartPhoneToggle = 'tablet';
                                                    } if (array_search("Wearables",$skuEntryColumnHeading,true)){
                                                        $tempSmartPhoneToggle = 'wearable';
                                                    } 
                                                       
                                                    
                                                    
                                                    
                                                    
                                                }      
                                        }
                                        $targetArray = [];//need a new array for each entry that can hold the stuff being pushed from the logic below, then that array needs to be pushed to the one being created for CSVing
                                    if ($tempmBrandArray != 'filthyAppleDevice' && $tempSmartPhoneToggle == 'smartphone')
                                    {
                                        $newSubTargetArray = $tempmBrandArray + $tempSkuDisplayNameArray +$tempMPriceArray + $tempMListPriceArray +$tempMModelArray+$tempMLargeImageArray +$tempMIdArray+$tempProductPageURLArray + $tempmNameArray +$tempSalesRankArray+$tempmStarRatingsArray+$tempmProductIdArray+$tempDeviceTypeArray+$tempmobileProductPageurlArray+$tempmProductPageURLEs+$tempMDescriptionArray+$tempMDueTodayArray+$tempPDPPageURLArray;
                                        
                                        array_push($targetArray,$newSubTargetArray);
                                        //echo $tempSmartPhoneToggle;
                                        //var_dump($newSubTargetArray);//this can just be pushed into the big array?
                                        //echo '<br><br>';
                                        
                                        //var_dump($smartphonesToggle);
                                        //echo '<br><br>';
                                        // $newSubTargetArray = $tempmBrandArray=$tempSkuDisplayNameArray=$tempMPriceArray=$tempMListPriceArray=$tempMModelArray=$tempMLargeImageArray=$tempMIdArray=$tempProductPageURLArray=$tempmNameArray=$tempSalesRankArray=$tempmStarRatingsArray=$tempmProductIdArray=$tempDeviceTypeArray=$tempmobileProductPageurlArray=$tempmProductPageURLEs=$tempMDescriptionArray=$tempMDueTodayArray=$tempPDPPageURLArray =null;
                                    }
                                    //var_dump($targetArray);//I think for given value of work, this does
                                    
                                    //convert array to csv file
                                    $fp = fopen('C:\xampp\htdocs\MARTIN_OLSON_ATT_ACTIVITY\MARTIN_OLSON_ATT_ACTIVITY.csv','w');
                                    
                                    foreach ($targetArray as $fields){
                                        fputcsv($fp,$fields);
                                    }
                                    fclose($fp);
                                    
                                    //send csv file     
                                    $host ='flashtalking.exavault.com';
                                    $port =21;
                                    $user = 'japac_testing';
                                    $secureport = 22;
                                    $ftp_password = 'h8wDT*9D%L(H&4gw';
                                    $file = 'C:\xampp\htdocs\MARTIN_OLSON_ATT_ACTIVITY\MARTIN_OLSON_ATT_ACTIVITY.csv';
                                    $ftpServer = 'ftp://japac_testing:h8wDT*9D%L(H&4gw@flashtalking.exavault.com/';

                                    $ftp = ftp_connect($host,22,90);
                                    ftp_login($ftp,$user,$ftp_password);
                                    echo 'upload commencing...<br><br>';

                                    $ret = ftp_nb_put($ftp,'MARTIN_OLSON_ATT_ACTIVITY.csv',$file,FTP_BINARY,FTP_AUTORESUME);
                                    
                                    while (FTP_MOREDATA == $ret){
                                        echo 'uploading...';
                                        $ret = ftp_nb_continue($ftp);
                                    }
                                    ftp_close($ftp);
                                    echo '<br><br>upload complete :)';
                                }
                            }
                        }  
            }
            ?>
        </div>
    </body>
</html>