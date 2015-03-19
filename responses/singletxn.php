<?php

include '../db/dbinfo.php';

foreach ($servers as $key => $value) {

    $conn = oci_new_connect($servers[$key]['user'], $servers[$key]['password'], $servers[$key]['url']);

    if (!$conn) {
        $e = oci_error();
        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    }

    // GET RESPONSES FROM ONE DB
    $responses = array();

    $txnid = $_POST['txnid'];

    $sql = "SELECT F(soresponsedata) as RESPONSE FROM SORECORD S, SORESPONSE SR WHERE SR.SOID = S.SOID AND S.TRANSACTIONID='" . $txnid . "'";

    $stid = oci_parse($conn, $sql);

    if (!$stid) {
        $e = oci_error($stid);
        echo $e['message'];
    }

    $r = oci_execute($stid);

    if (!$r) {
        $error = oci_error($stid);
        echo $error['message'];
    }

    $row = oci_fetch_assoc($stid);
    if ($row) {
        $responses[] = $row["RESPONSE"]->load();
    }

    $child = array();

    $sizeOfResponses = sizeof($responses);
    for ($i = 0; $i < $sizeOfResponses; $i++) {
        $xml = $responses[$i];
        $xml = new SimpleXMLElement($xml);
        $child[] = $xml->children('dss', TRUE);
    }

    oci_free_statement($stid);
    oci_close($conn);

    //CONVERT RESPONSES TO TIP FORMAT
    $sizeOfChild = sizeof($child);
    for ($c = 0; $c < $sizeOfChild; $c++) {
        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->startDocument();
        $xml->startElementNS('aetgt', 'DeliverServiceResponse', 'http://www.tele2.com/DeliverServiceResponse/Canonical/v01');
        $xml->writeAttribute('xmlns:ns2', 'http://www.tele2.com/DeliverServiceResponse/Canonical/v01');
        $xml->writeAttribute('xmlns:ns', 'http://www.tele2.com/Common/MessageHeader/v02');

        $xml->startElementNS('ns2', 'Header', null);
        $xml->writeElementNS('ns', 'MessageId', null, 'ProvidentM' . date('Y-m-d') . 'T' . date('H:i:s') . '+02:00');
        $xml->writeElementNS('ns', 'ConversationId', null, $child[$c]->ConvID);
        $xml->writeElementNS('ns', 'BusinessProcessId', null, $child[$c]->BusinessProcessId);
        $xml->writeElementNS('ns', 'MessageTargetNamespace', null, 'http://new.webservice.namespace');
        $xml->writeElementNS('ns', 'MessagePriority', null, '4');
        $xml->writeElementNS('ns', 'Timestamp', null, date('Y-m-d') . 'T' . date('H:i:s') . 'Z');
        $xml->writeElementNS('ns', 'Sender', null, $child[$c]->Sender);
        $xml->writeElementNS('ns', 'Recipient', null, $child[$c]->Recipient);
        $xml->writeElementNS('ns', 'LegalEntity', null, $child[$c]->LegalEntity);
        $xml->writeElementNS('ns', 'PayloadEncoding', null, 'Plain');
        $xml->endElement();

        $xml->startElementNS('ns2', 'Body', null);
        $xml->startElementNS('ns2', 'ServiceOrderStatus', null);
        $xml->writeElementNS('ns2', 'ServiceOrderID', null, $child[$c]->TXNID);
        $xml->writeElementNS('ns2', 'StatusCode', null, $child[$c]->StatusCode);
        $xml->writeElementNS('ns2', 'StatusReason', null, $child[$c]->StatusReason);

        for ($i = 0; $i < sizeof($child[$c]->SOInstanceResponses); $i++) {
            $xml->startElementNS('aetgt', 'ServiceInstanceOrderStatus', null);
            $xml->writeElementNS('ns2', 'ServiceInstanceOrderID', null, $child[$c]->SOInstanceResponses[$i]->ServiceInstanceOrderID);
            $xml->writeElementNS('ns2', 'ServiceSpecificationName', null, $child[$c]->SOInstanceResponses[$i]->ServiceSpecificationName);
            $xml->writeElementNS('ns2', 'StatusCode', null, $child[$c]->SOInstanceResponses[$i]->StatusCode);
            $xml->writeElementNS('ns2', 'StatusReason', null, $child[$c]->SOInstanceResponses[$i]->StatusReason);
            $xml->endElement();
        }

        $xml->endElement();
        $xml->endElement();
        $xml->endElement();
        $xml = $xml->outputMemory();

        $xml = str_replace('<?xml version="1.0"?>', '', $xml);

        $result = '';

        exec("curl --user PRD_PROV:l3tsw0rk -H 'Content-Type: text/xml; charset=utf-8' --verbose -H 'SOAPAction:' -d '" . $xml . "' -X POST 'http://90.131.21.33:5501/ws/TIP_DeliverService_v01_NP_Provident.request.v01.webService:handleAsyncResponse'", $result, $returnCode);

        //PARSE RESPONSE
        $clean_xml = str_replace('soapenv:', '', $result);
        $clean_xml = str_replace('tns:', '', $clean_xml);
        $clean_xml = str_replace('header:', '', $clean_xml);
        $clean_xml = str_replace("<?xml version='1.0' encoding='utf-8'?>", '', $clean_xml);
        $xml = simplexml_load_string($clean_xml[0]);
        $statusCode = $xml->Body->CommonResponse->Body->StatusCode[0];

        if ($statusCode == 0) {
            echo '<li class="success">' . $child[$c]->TXNID . '</li>';
        } else {
            echo '<li class="error">' . $child[$c]->TXNID . ' (' . $statusCode . ')</li>';
        };

    }

}
