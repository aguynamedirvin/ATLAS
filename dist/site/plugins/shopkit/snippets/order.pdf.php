<?php

// Set detected language
site()->visit('home', $lang);
site()->kirby->localize();

// Page URI sent via POST
$p = page(get('uri'));

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate the dompdf class
$dompdf = new Dompdf();

// Build the HTML
$html = '<style>body{font-family: sans-serif;}</style>';
$html .= '<h1>'.site()->title().'</h1>';

$contact = page('contact');
if ($phone = $contact->phone() and $phone != '') {
  $html .='<p><strong>'.l::get('phone').'</strong><br>'.$phone.'</p>';
}
if ($email = $contact->email() and $email != '') {
  $html .='<p><strong>'.l::get('email').'</strong><br>'.$email.'</p>';
}
if ($address = $contact->location()->toStructure()->address() and $address != '') {
  $html .='<p><strong>'.l::get('address').'</strong><br>'.$address.'</p>';
}

$html .= '<hr>';

$html .= '<p>'.l::get('invoice').' No. <strong>'.$p->txn_id()->value.'</strong> ('.l::get($p->status()->value).')</p>';
$html .= '<p><em>'.date('F j, Y H:i',$p->txn_date()->value).'</em></p>';
$html .= '<p>'.l::get('bill-to').': '.$p->payer_id()->value.'   '.$p->payer_email()->value.'</p>';
$html .= '<hr>';

if (strpos($p->products(),'uri:')) {
  // Show products overview with download links
  foreach ($p->products()->toStructure() as $product) {
      $html .= '<p>'.$product->name().'<br><small>'.$product->variant();
      $html .= $product->option()->isNotEmpty() ? ' / '.$product->option() : '';
      $html .= ' / '.l::get('qty').$product->quantity();
      $html .= '</small></p>';
  }
} else {
  // Old transaction files from Shopkit 1.0.5 and earlier
  $html .= $p->products()->kirbytext()->bidi();
}

$html .= '<hr>';
$html .= '<p>'.l::get('subtotal').': '.formatPrice($p->subtotal()->value).'</p>';
$html .= '<p>'.l::get('shipping').': '.formatPrice($p->shipping()->value).'</p>';
$html .= '<p>'.l::get('tax').': '.formatPrice($p->tax()->value).'</p>';
$html .= '<p><strong>'.l::get('total').': '.formatPrice($p->subtotal()->value+$p->shipping()->value+$p->tax()->value).'</strong></p>';
$html .= '<p><strong>'.l::get('gift-certificate').': &ndash; '.formatPrice($p->giftcertificate()->value).'</strong></p>';

// Load the html
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream();