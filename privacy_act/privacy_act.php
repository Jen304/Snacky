<?php
include('../includes/header.php');
include('../includes/db_connection.php');
?>
<title>Privacy Act | Snacky</title>

</head>

<body>

<?php

	session_start();
	
	//getting userid from session
	$userid = $_SESSION['userid'];
	
	//setup timezone
	//date_default_timezone_set('America/Vancouver');

	if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
		
		//declaring variables
		//$current_login_date = date('Y-m-d H:i:s');
		//$privacy_selection = "SELECT * FROM privacy_selection WHERE customer_id = $userid;";
		//$result_pa = mysqli_query($dbc, $privacy_selection);
		
		//checking what button was clicked
		//decline button behavior
		//if(isset($_POST["privacy"])) {
			//zero(0) means false for database
			//$selection = 0;
			//What happend if no records
			//if(mysqli_num_rows($result_pa) < 1){
				//$paquery = "INSERT INTO privacy_selection (customer_id, selection_date, selection_choice)
								//VALUES ('$userid', '$current_login_date', '$selection');";
				//mysqli_query($dbc, $paquery);	
			//$sql_query = "UPDATE customer SET privacy_selection=false where customer_id=$userid";
			//mysqli_query($dbc, $sql_query);
			}
			//echo '<script> alert("You are logging out...");
			//		location="../logout.php";</script>';
		
		//accept button behavior
		if(isset($_POST["privacy"])) {
			//one(1) means true for database
			//$selection = 1;
			//what happend if no records
			//if(mysqli_num_rows($result_pa) < 1){
				//$paquery = "INSERT INTO privacy_selection (customer_id, selection_date, selection_choice)
				//				VALUES ('$userid', '$current_login_date', '$selection');";
				//mysqli_query($dbc, $paquery);	
				if($_POST["privacy"] == "Accept"){
					
					echo '<script> alert("You are logging in...");
					location="../index.php";</script>';
					
				}else{
					$sql_query = "UPDATE customer SET privacy_selection=false where customer_id=$userid";
					mysqli_query($dbc, $sql_query);
					echo '<script> alert("You are logging out...");
					location="../logout.php";</script>';
				}
				
			}
			//what happend if records
			//if(mysqli_num_rows($result_pa) > 0){
			//	$paquery = "UPDATE privacy_selection SET selection_date = NOW(), selection_choice = $selection
			//					WHERE customer_id = $userid;";
			//	mysqli_query($dbc, $paquery);	
			//}
			
		
	

echo '<!-- Modal -->
<div class="modal fade" id="privacy-policy" tabindex="-1" role="dialog" aria-labelledby="title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="title">Privacy Policy for Snacky</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<p>The Canadian federal government will be introducing a new privacy protection law within a few months called 
		the “General Data Protection Regulation”. This law will require that individuals must give explicit permission 
		for their data to be used and give individuals the right to know who is accessing their information and what it 
		will be used for. All companies collecting and/or using personal information on Canadian citizens must comply with 
		this new law.</p>
        <p>At Snacky, one of our main priorities is the privacy of our visitors. 
	This Privacy Policy document contains types of information that is collected 
	and recorded by Shopping Cart and how we use it. If you have additional questions
	or require more information about our Privacy Policy, do not hesitate to contact us. 
	This Privacy Policy applies only to our online activities and is valid for visitors 
	to our website with regards to the information that they shared and/or collect in Shopping Cart. 
	This policy is not applicable to any information collected offline or via channels other than this website.</p>

<h3>Consent</h3>
<p>By using our website, you hereby consent to our Privacy Policy and agree to its terms.</p>

<h3>Information We Collect</h3>
<p>The personal information that you are asked to provide, and the reasons why you are asked to provide it, 
	will be made clear to you at the point we ask you to provide your personal information. If you contact 
	us directly, we may receive additional information about you such as your name, email address, phone number, 
	the contents of the message and/or attachments you may send us, and any other information you may choose to provide. 
	When you register for an Account, we may ask for your contact information, including items such as name, company name, 
	address, email address, and telephone number.</p>

<h3>How We Use Your Information</h3>
<p>We use the information we collect in various ways, including to:</p>
<ul>
<li>Provide, operate, and maintain our website.</li>
<li>Improve, personalize, and expand our website.</li>
<li>Understand and analyze how you use our website.</li>
<li>Develop new products, services, features, and functionality.</li>
<li>Communicate with you, either directly or through one of our partners, including for customer service, 
	to provide you with updates and other information relating to the webste, and for marketing and promotional purposes.</li>
<li>Send you emails.</li>
<li>Find and prevent fraud.</li>
</ul>
<br>

<h3>Log Files</h3>
<p>Shopping Cart follows a standard procedure of using log files. These files log visitors when they visit websites. 
	All hosting companies do this and a part of hosting services analytics. The information collected by log files 
	include internet protocol (IP) addresses, browser type, Internet Service Provider (ISP), date and time stamp, 
	referring/exit pages, and possibly the number of clicks. These are not linked to any information that is personally 
	identifiable. The purpose of the information is for analyzing trends, administering the site, tracking users movement 
	on the website, and gathering demographic information. Our Privacy Policy was created with the help of the Privacy Policy 
	Generator and the Online Privacy Policy Generator.</p>

<h3>Advertising Partners Privacy Policies</h3>
<p>You may consult this list to find the Privacy Policy for each of the advertising partners of Shopping Cart.
	Third-party ad servers or ad networks uses technologies like cookies, JavaScript, or Web Beacons that are used in 
	their respective advertisements and links that appear on Shopping Cart, which are sent directly to users browser. 
	They automatically receive your IP address when this occurs. These technologies are used to measure the effectiveness 
	of their advertising campaigns and/or to personalize the advertising content that you see on websites that you visit. 
	Note that Shopping Cart has no access to or control over these cookies that are used by third-party advertisers.</p>

<h3>Third Party Privacy Policies</h3>
<p>Shopping Cart Privacy Policy does not apply to other advertisers or websites. Thus, we are advising you to consult the 
	respective Privacy Policies of these third-party ad servers for more detailed information. It may include their practices 
	and instructions about how to opt-out of certain options. You can choose to disable cookies through your individual 
	browser options. To know more detailed information about cookie management with specific web browsers, it can be found 
	at the browsers respective websites.</p>

<h3>CCPA Privacy Rights (Do Not Sell My Personal Information)</h3>
<p>Under the CCPA, among other rights, California consumers have the right to:</p>
<ul>
<li>Request that a business that collects a consumers personal data disclose the categories and specific pieces of personal 
	data that a business has collected about consumers.</li>
<li>Request that a business delete any personal data about the consumer that a business has collected.</li>
<li>Request that a business that sells a consumers personal data, not sell the consumers personal data.</li>
<li>If you make a request, we have one month to respond to you. If you would like to exercise any of these rights, please 
	contact us.</li>
</ul>
<br>

<h3>GDPR Data Protection Rights</h3>
<p>We would like to make sure you are fully aware of all of your data protection rights. Every user is entitled to the following:</p>
<ul>
<li>The right to access – You have the right to request copies of your personal data. We may charge you a small fee for this service.</li>
<li>The right to rectification – You have the right to request that we correct any information you believe is inaccurate. You also 
	have the right to request that we complete the information you believe is incomplete.</li>
<li>The right to erasure – You have the right to request that we erase your personal data, under certain conditions.</li>
<li>The right to restrict processing – You have the right to request that we restrict the processing of your personal data, under certain conditions.</li>
<li>The right to object to processing – You have the right to object to our processing of your personal data, under certain conditions.</li>
<li>The right to data portability – You have the right to request that we transfer the data that we have collected to another organization, 
	or directly to you, under certain conditions.</li>
<li>If you make a request, we have one month to respond to you. If you would like to exercise any of these rights, please contact us.</li>
</ul>
<br>

<h3>Childrens Information</h3>
<p>Another part of our priority is adding protection for children while using the internet. We encourage parents and guardians to observe, 
	participate in, and/or monitor and guide their online activity. Shopping Cart does not knowingly collect any Personal Identifiable 
	Information from children under the age of 13. If you think that your child provided this kind of information on our website, 
	we strongly encourage you to contact us immediately and we will do our best efforts to promptly remove such information from our records.</p>
      </div>
      <div class="modal-footer">
	  <form action="privacy_act.php" method="POST">
		<input id="decline" name="privacy" type="submit" class="btn btn-secondary" value="Decline">
		<input id="accept" name="privacy" type="submit" class="btn btn-secondary" value="Accept">
	  </form>
      </div>
    </div>
  </div>
</div>';
?>

<!--javascript to lunch the modal on a load page-->
<script>
	$(function() {
		$("#privacy-policy").modal();
	});
</script>

<?php
include ('../includes/footer.php');
?>




