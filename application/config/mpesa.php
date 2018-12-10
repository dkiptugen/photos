<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['ConsumerKey']				=	'pWWBSC9kMrQAILyZjiDQU3PcqAaj42fc';
$config['ConsumerSecret']			=	'CzCgppD25CfHCGNP';
$config["Auth_link"]				=	'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

//Mpesa Checkout
$config['checkout_processlink']		=	'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest'; 
$config['checkout_querylink']		=	'https://sandbox.safaricom.co.ke/mpesa/stkpushquery/v1/query';
$config['checkout_shortcode']		=	'174379';
$config['checkout_passkey']			=	'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
$config['checkout_callbackurl']		=	'https://www.standardmedia.co.ke/magazines/callback';

// Mpesa Reversal
$config['R_reversal_link']			= 	'https://sandbox.safaricom.co.ke/mpesa/reversal/v1/request';
$config['R_reversal_initiator']		= 	'testapi781';
$config['R_SecurityCredential']		=	'S4wTQdmU';
$config['R_ReceiverParty']			=	'600781';	//SHORTCODE or MSISDN of organization
$config['R_ReceiverIdentifierType'] = 	'4'; // 1 – >MSISDN 2–>Till Number 4–>Organization short code
$config['R_ResultURL']				= 	'https://178.62.89.99/result_url';
$config['R_QueueTimeOutURL']		=	'https://178.62.89.99';