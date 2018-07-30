<?php
/**
 * User: kendo    Date: 2018/2/28
 */
$str = '<?xml version="1.0" encoding="utf-8"?>
<GetOrdersResponse xmlns="urn:ebay:apis:eBLBaseComponents">
  <Timestamp>2015-12-10T16:12:55.184Z</Timestamp>
  <Ack>Success</Ack>
  <Version>967</Version>
  <Build>e967_core_Bundled_5642307_R1</Build>
  <OrderArray>
    <Order>
      <OrderID>865826</OrderID>
      <OrderStatus>Active</OrderStatus>
      <AdjustmentAmount currencyID="USD">0.0</AdjustmentAmount>
      <AmountSaved currencyID="USD">0.0</AmountSaved>
      <CheckoutStatus>
        <eBayPaymentStatus>NoPaymentFailure</eBayPaymentStatus>
        <LastModifiedTime>2015-12-10T16:09:47.000Z</LastModifiedTime>
        <PaymentMethod>None</PaymentMethod>
        <Status>Incomplete</Status>
      </CheckoutStatus>
      <ShippingDetails>
        <SalesTax>
          <SalesTaxPercent>0.0</SalesTaxPercent>
          <SalesTaxState/>
          <ShippingIncludedInTax>false</ShippingIncludedInTax>
          <SalesTaxAmount currencyID="USD">0.0</SalesTaxAmount>
        </SalesTax>
        <ShippingServiceOptions>
          <ShippingService>ShippingMethodStandard</ShippingService>
          <ShippingServicePriority>1</ShippingServicePriority>
          <ExpeditedService>false</ExpeditedService>
        </ShippingServiceOptions>
        <SellingManagerSalesRecordNumber>111</SellingManagerSalesRecordNumber>
      </ShippingDetails>
      <CreatingUserRole>Seller</CreatingUserRole>
      <CreatedTime>2015-12-10T16:09:47.000Z</CreatedTime>
      <PaymentMethods>PayPal</PaymentMethods>
      <ShippingAddress>
        <Name>Test User</Name>
        <Street1>address</Street1>
        <Street2/>
        <CityName>city</CityName>
        <StateOrProvince>WA</StateOrProvince>
        <Country>CustomCode</Country>
        <CountryName/>
        <Phone>1-800-111-1111</Phone>
        <PostalCode>98102</PostalCode>
        <AddressID>3839387</AddressID>
        <AddressOwner>eBay</AddressOwner>
        <ExternalAddressID/>
      </ShippingAddress>
      <Subtotal currencyID="USD">36.0</Subtotal>
      <Total currencyID="USD">36.0</Total>
      <DigitalDelivery>false</DigitalDelivery>
      <TransactionArray>
        <Transaction>
          <Buyer>
            <Email>magicalbookseller@yahoo.com</Email>
          </Buyer>
          <ShippingDetails>
            <SellingManagerSalesRecordNumber>104</SellingManagerSalesRecordNumber>
          </ShippingDetails>
          <Item>
            <ItemID>110025788368</ItemID>
          </Item>
          <QuantityPurchased>1</QuantityPurchased>
          <TransactionID>0</TransactionID>
          <TransactionPrice currencyID="USD">18.0</TransactionPrice>
        </Transaction>
        <Transaction>
          <Buyer>
            <Email>magicalbookseller@yahoo.com</Email>
          </Buyer>
          <ShippingDetails>
            <SellingManagerSalesRecordNumber>103</SellingManagerSalesRecordNumber>
          </ShippingDetails>
          <Item>
            <ItemID>110025788765</ItemID>
          </Item>
          <QuantityPurchased>1</QuantityPurchased>
          <TransactionID>0</TransactionID>
          <TransactionPrice currencyID="USD">18.0</TransactionPrice>
        </Transaction>
      </TransactionArray>
      <BuyerUserID>magicalbookseller</BuyerUserID>
    </Order>
  </OrderArray>
</GetOrdersResponse>';

class simple_xml_extended extends SimpleXMLElement
{
    public function Attribute($name)
    {print_r($this->Attributes());die;
        foreach ($this->Attributes() as $key => $val) {
            if ($key == $name)
                return (string)$val;
        }
    }

}
//$xml = simplexml_load_file('a.xml');
$xml = simplexml_load_string($str, 'simple_xml_extended');

print_r($xml->OrderArray->Order->AdjustmentAmount->Attribute('currencyID'));

/*
$parserTor = xml_parser_create();
xml_parse_into_struct($parserTor, $str, $vals, $index);
xml_parser_free($parserTor);

print_r(simplexml_load_string($str,'SimpleXMLElement'));
*/