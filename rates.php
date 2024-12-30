<?php include 'header.php';?>
<style>
.rates{ margin:0px auto 50px; text-transform:capitalize; font-family: 'Source Sans Pro', sans-serif; box-shadow:0 0 8px #ccc; }

.rates th{  padding:5px; font-size:16px; background:#13206b; color:#fff; font-weight:bold; text-align:left; }

.rates td{  padding:5px; font-size:14px; text-align:center;  }

.rates span{font-size:11px;}

.responsive-table b { color: #b80909; display: block; font-weight: 600; font-size: 12px; }

.responsive-table { width: 100%; margin-bottom: 1.5em; box-shadow:0 0 4px #ccc;}

.responsive-table thead { position: absolute; clip: rect(1px 1px 1px 1px);

  /* IE6, IE7 */ clip: rect(1px, 1px, 1px, 1px); padding: 0; border: 0; height: 1px; width: 1px; overflow: hidden;}

.responsive-table td  small {

    display: inline-block;

    width: 100%;

}

@media (min-width: 44em) {

.responsive-table thead { position: relative; clip: auto; height: auto; width: auto; overflow: auto;}

}

.responsive-table thead th { background-color:rgb(189, 168, 127); border: 1px solid rgb(190, 172, 90);  text-align: center; color:#fff; font-weight:600; font-size:18px; padding: 15px 15px; font-family:'Josefin Sans', sans-serif;}

.responsive-table thead th:first-of-type { text-align: center;}

.responsive-table tbody,

.responsive-table tr,

.responsive-table th,

.responsive-table td { display: block; padding: 0; text-align: left; white-space: normal;}

@media (min-width: 44em) {

.responsive-table tr { display: table-row;}

}

.responsive-table th,

.responsive-table td { padding: .5em; vertical-align: middle;}

@media (min-width: 30em) {

.responsive-table th,

.responsive-table td { padding: .75em .5em;}

}

@media (min-width: 44em) {

.responsive-table th,

.responsive-table td { display: table-cell; padding: .5em;}

}

@media (min-width: 62em) {

.responsive-table th,

.responsive-table td { padding: .75em .5em;}

}

@media (min-width: 75em) {

.responsive-table th,

.responsive-table td {padding: .75em;}

}

.responsive-table caption { margin-bottom: 1em; font-size: 1em; font-weight: bold; text-align: center;}

@media (min-width: 44em) {

.responsive-table caption { font-size: 1.5em;}

}

.responsive-table tfoot { font-size: .8em; font-style: italic;}

@media (min-width: 62em) {

.responsive-table tfoot { font-size: .9em;}

}

@media (min-width: 44em) {

.responsive-table tbody { display: table-row-group;}

}

.responsive-table tbody tr { margin-bottom: 1em; border: 1px solid #ccc;}

@media (min-width: 44em) {

.responsive-table tbody tr { display: table-row; border-width: 1px;}

}

.responsive-table tbody tr:last-of-type { margin-bottom: 0;}

@media (min-width: 44em) {

.responsive-table tbody tr:nth-of-type(even) { background-color: rgba(94, 93, 82, 0.1);}

}

.responsive-table tbody th[scope="row"] { background-color: #13206b; color: #fff;}

@media (min-width: 44em) {

.responsive-table tbody th[scope="row"] { background-color: transparent; color: #5e5d52; text-align: left;}

}

.responsive-table tbody td { text-align: right; background:#fff;}

@media (min-width: 30em) {

.responsive-table tbody td { border: 1px solid #ccc;font-size: 15px;}

}

@media (min-width: 44em) {

.responsive-table tbody td { 

text-align: center;

color: #000;

font-size: 18px;

padding: 15px;

background: rgba(255, 255, 255, 0.36);

}

}

.responsive-table tbody td[data-type=currency] { text-align: right;}

.responsive-table tbody td[data-title]:before { content: attr(data-title); float: left; font-size:13px;  font-weight:600;color:rgb(17, 90, 41); font-family: 'Josefin Sans', sans-serif; text-shadow: 0 0px 0px #111;}

@media (min-width: 30em) {

.responsive-table tbody td[data-title]:before { font-size: .9em;}

}

@media (min-width: 44em) {

.responsive-table tbody td[data-title]:before { content: none;}

}
.ratesAdditional {
    width: 100%;
    padding: 50px 0;
    text-align: center;
    border-bottom: 1px dashed rgba(0, 0, 0, 0.39);
    margin: 0 auto 50px;
    padding-top: 5px;
}
.ratesAdditional ul {
    vertical-align: top;
    width: 60%;
    margin: 0;
    padding: 0;
}
.ratesAdditional ul li {
    border-bottom: 2px solid #fff;
    padding: 0;
    list-style: none;
    margin: 0;
    display: inline-block;
    width: 100%;
    text-align: left;
}
.ratesAdditional strong {
    width: 50%;
    text-transform: uppercase;
    font-size: 14px;
    font-weight: 400;
    border-right: 1px solid #bbb;
    background: #beac5a;
    display: inline-block;
    color: #fff;
    padding: 10px;
}
.ratesAdditional span {
    background:rgba(32, 41, 53, 0.16);
    color: #000;
    width: 48%;
    display: inline-block;
    padding: 10px;
	font-size: 13px;
    font-weight: bold;
}</style>
<div class='page-title'>
	<div id='particles-js-pagetitle'></div>
	<div class='container'>
		<h1>Rates & Availability</h1><h6>Fripp Island</h6>
	</div>
</div>

<div class='section-block'>  
	<div class='container'>

               		<div class="mt-30 section-heading"><h2 class="fadeInLeft wow animated" style="visibility: visible; animation-name: fadeInLeft;">Rates</h2></div>  
                    <div class="">
                     <div class="rates">
                        <div class="responsiveTab">
                            <table class="responsive-table">
                             <thead>
                            <tr>
                            <th scope="col">Dates</th>
                            <th scope="col">Nightly</th>
                            <th scope="col">Weekend Night</th>
                            <th scope="col">Weekly</th>
                            <th scope="col">Monthly*</th>
                            <!--<th scope="col">Events</th>-->
                            </tr>
                            </thead>
                            
                            <tbody>
                 <?php $rate = mysqli_query($conn,"SELECT * FROM lhk_property_new_rates"); 
                       while($rates = mysqli_fetch_assoc($rate)){?>           
                <tr>
                  <th scope="row"><?php echo $rates['pro_new_rate_desc'];?><br/> <?php echo $rates['pro_new_rate_min_stay'];?> nights min stay</small></th>
                  <td data-title="Nightly"><?php echo $rates['pro_new_rate_week_nt']!=""?'$'.$rates['pro_new_rate_week_nt']:"-";?></td>
          <td data-title="Weekend Night"><?php echo $rates['pro_new_rate_weekend_nt']!=""?'$'.$rates['pro_new_rate_weekend_nt']:"-";?></td>
        <td data-title="Weekly"><?php echo $rates['pro_new_rate_weekly_nt']!=""?'$'.$rates['pro_new_rate_weekly_nt']:"-";?></td>
        <td data-title="Monthly"><?php echo $rates['pro_new_rate_monthly']!=""?'$'.$rates['pro_new_rate_monthly']:"-";?></td>
          <!--<td data-title="Event"> - </td>-->
                </tr>
                 <?php } ?>
                                             </tbody>
                            
                            </table>
                       </div>
                       
                       
                       
                                              <!--<p class="text-center"><strong>* Approximate monthly rate. Actual rate will depend on the days of the month you stay.</strong>
</p>-->		
                                           </div>
                    </div>
                    
<?php $prate = mysqli_query($conn,"SELECT * FROM lhk_property_default_rates");
        $prates =mysqli_fetch_assoc($prate)
?>
               		<div class="mt-30 section-heading"><h2 class="fadeInLeft wow animated" style="visibility: visible; animation-name: fadeInLeft;">Additional information about rental rates</h2></div>  
                    <div class="pricing-box">
                    <ul>
                                             <li>
                        
                    <strong>Property Damage Protection</strong> : <span><?php echo $prates['pro_refundable_amt']!=""?'$'.$prates['pro_refundable_amt']:"-";?></span>
                    </li>            
                                                             <li>
                    <strong>Cleaning Fee</strong> : <span><?php echo $prates['pro_cleaning_fee']!=""?'$'.$prates['pro_cleaning_fee']:"-";?></span>
                    </li>
                                                            <li>
                    <strong>Tax Rate</strong> : <span><?php echo $prates['add_fees']!=""?$prates['add_fees'].'%':"-";?></span>
                    </li>
                    <li>
                    <strong>Pet Fee</strong> : <span>$100</span>
                    </li>
                     
                    </ul>
                    </div>
					
         <?php if($prates['can_policy']!=""){?>
		 <div class="mt-30 section-heading"><h2 class="fadeInLeft wow animated" style="visibility: visible; animation-name: fadeInLeft;">Owner's Cancellation Policy</h2></div>
                    
                    <div class="text-content">
                       <p><?php echo html_entity_decode($prates['can_policy']);?></p>


                    </div>
                 <?php } ?>
<?php if($prates['notes']!=""){?>
 <div class="mt-30 section-heading"><h2 class="fadeInLeft wow animated" style="visibility: visible; animation-name: fadeInLeft;">Notes</h2></div>
<div class="text-content">
                       <p><?php echo html_entity_decode($prates['notes']);?></p>
                    </div>
<?php } ?>
 <div class="mt-30 section-heading"><h2 class="fadeInLeft wow animated" style="visibility: visible; animation-name: fadeInLeft;">Availability</h2></div>
                     <iframe class="container-fluid" id="pro_cal" src="calender/calender.php?property=1" width="100%" height="560px" frameborder="0"></iframe>
                    
</div>
</div>
<?php include 'footer.php';?>