<?php

class Bookings {
  function get($f3, $args) {
    // print_r($args);
    if (is_array($args)){
      $query = $this->proper_parse_str($f3->get('QUERY'));
    } else {
      $query = $this->proper_parse_str($args);
    }
 
      $cols = array('BookingID', 'RequestedPickupTime', 'PickupAddress', 'DropoffAddress', 'Cost', 'PaymentMethod', 'DriverDetails', 'DropOffFee', 'ParkingFee', 'WaitingFee', 'OtherFee', 'OtherDescription');
      
      $q = $this->queryToPreppedSql($query);
      $result = $f3->DB->exec(
        "SELECT " . implode(",",$cols) ." from bookings where " . $q[0],
        $q[1]
      );
      
      if (is_array($args)) {
        echo JSON_encode($result);
      } else {
        return $result;
      }
          
  }

  private function queryToPreppedSql ($query) {
    /*
      eq - equal to
      gt(e) = greater than
      lt(e) - less than
    */
    $retArr = array();
    $retVals = array();
    // print_r($query);
    foreach ($query as $key => $q) {
        if (preg_match('/\[([^]]*)\]/', $key, $match)) {
          $value = $match[1];
          $keyVal = explode('[', $key);
          // print_r($keyVal[0]);
          switch ($keyVal[0]) {
            case 'eq':
              array_push($retArr, $value . " = :eq" . $value);
              $retVals[':eq' . $value]=urldecode($q);
              break;
            case 'gt':
              // array_push($retArr, $value . " > :gt" . $value);
              array_push($retArr, $value . " > :gt" . $value);
              $retVals[':gt' . $value]=urldecode($q);
              break;
            case 'gte':
              // array_push($retArr, $value . " >= :gte" . $value);
              array_push($retArr, $value . " >= :gte" . $value);
              $retVals[':gte' . $value]=urldecode($q);
              break;
            case 'lt':
                // array_push($retArr, $value . " < :lt" . $value);
                array_push($retArr, $value . " < :lt" . $value);
                $retVals[':lt' . $value]=urldecode($q);
                break;
            case 'lte':
                // array_push($retArr, $value . " <= 'lte" . $value);
                array_push($retArr, $value . " <= :lte" . $value);
                $retVals[':lte' . $value]=urldecode($q);
                break;
              // case 'o':
              //   array_push($ret,)
            default:
              break;
          }
        }
    }
    return array(implode(" AND ", $retArr), $retVals);
  }

  private function queryToSql ($query) {
    /*
      eq - equal to
      gt(e) = greater than
      lt(e) - less than
    */
    $retArr = [];
    // print_r($query);
    foreach ($query as $key => $q) {
        if (preg_match('/\[([^]]*)\]/', $key, $match)) {
          $value = $match[1];
          $keyVal = explode('[', $key);
          switch ($keyVal[0]) {
            case 'eq':
              array_push($retArr, $value . " = '" . urldecode($q) . "'");
              break;
            case 'gt':
              array_push($retArr, $value . " > '" . urldecode($q) . "'");
              break;
            case 'gte':
              array_push($retArr, $value . " >= '" . urldecode($q) . "'");
              break;
              case 'lt':
                array_push($retArr, $value . " < '" . urldecode($q) . "'");
                break;
              case 'lte':
                array_push($retArr, $value . " <= '" . urldecode($q) . "'");
                break;
              // case 'o':
              //   array_push($ret,)
            default:
              break;
          }
        }
    }
    return (implode(" AND ", $retArr));
  }

  private function proper_parse_str($str) {
    # result array
    $arr = array();
  
    # split on outer delimiter
    $pairs = explode('&', $str);
  
    # loop through each pair
    foreach ($pairs as $i) {
      # split into name and value
      list($name,$value) = explode('=', $i, 2);
     
      # if name already exists
      if( isset($arr[$name]) ) {
        # stick multiple values into an array
        if( is_array($arr[$name]) ) {
          $arr[$name][] = $value;
        }
        else {
          $arr[$name] = array($arr[$name], $value);
        }
      }
      # otherwise, simply stick it in a scalar
      else {
        $arr[$name] = $value;
      }
    }
  
    # return result array
    return $arr;
  }
}