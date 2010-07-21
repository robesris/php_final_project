<?php
include './auth.inc';

function logout() {
  session_destroy();
  foreach ($_COOKIE as $cookie_name => $value) {
    setcookie($cookie_name, "", time() - 42000, "/");
    unset($_COOKIE[$cookie_name]);
  }
}

function validate_cc($cc_num, $cc_type) {
  $cc_type = strtolower($cc_type);
  
  // check format
  if ($cc_type == 'visa') {
    if (!preg_match('/^4\d{12}(\d{3})?$/', $cc_num)) return false;
  } elseif ($cc_type == 'mastercard') {
    if (!preg_match('/^5[1-5]\d{14}$/', $cc_num)) return false;
  } else {
    return false;
  }
  
  // Luhn 10
  $alt = false;
  $sum = 0;
  for ($i = strlen($cc_num) - 1; $i >= 0; $i--) {
    $num = $cc_num[$i];
    if ($alt) {
      $num *= 2;
      $num = $num >= 10 ? $num % 10 + 1 : $num;
    }
    $sum += $num;
    $alt = !$alt;
  }
  return $sum % 10 == 0;
}

$months = array(
  'jan' => "January",
  'feb' => "February",
  'mar' => "March",
  'apr' => "April",
  'may' => "May",
  'jun' => "June",
  'jul' => "July",
  'aug' => "August",
  'sep' => "September",
  'oct' => "October",
  'nov' => "November",
  'dec' => "December");

$us_states = array(
      'AL'=>"Alabama",  
			'AK'=>"Alaska",  
			'AZ'=>"Arizona",  
			'AR'=>"Arkansas",  
			'CA'=>"California",  
			'CO'=>"Colorado",  
			'CT'=>"Connecticut",  
			'DE'=>"Delaware",  
			'DC'=>"District Of Columbia",  
			'FL'=>"Florida",  
			'GA'=>"Georgia",  
			'HI'=>"Hawaii",  
			'ID'=>"Idaho",  
			'IL'=>"Illinois",  
			'IN'=>"Indiana",  
			'IA'=>"Iowa",  
			'KS'=>"Kansas",  
			'KY'=>"Kentucky",  
			'LA'=>"Louisiana",  
			'ME'=>"Maine",  
			'MD'=>"Maryland",  
			'MA'=>"Massachusetts",  
			'MI'=>"Michigan",  
			'MN'=>"Minnesota",  
			'MS'=>"Mississippi",  
			'MO'=>"Missouri",  
			'MT'=>"Montana",
			'NE'=>"Nebraska",
			'NV'=>"Nevada",
			'NH'=>"New Hampshire",
			'NJ'=>"New Jersey",
			'NM'=>"New Mexico",
			'NY'=>"New York",
			'NC'=>"North Carolina",
			'ND'=>"North Dakota",
			'OH'=>"Ohio",  
			'OK'=>"Oklahoma",  
			'OR'=>"Oregon",  
			'PA'=>"Pennsylvania",  
			'RI'=>"Rhode Island",  
			'SC'=>"South Carolina",  
			'SD'=>"South Dakota",
			'TN'=>"Tennessee",  
			'TX'=>"Texas",  
			'UT'=>"Utah",  
			'VT'=>"Vermont",  
			'VA'=>"Virginia",  
			'WA'=>"Washington",  
			'WV'=>"West Virginia",  
			'WI'=>"Wisconsin",  
			'WY'=>"Wyoming");