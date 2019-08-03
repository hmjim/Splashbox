<?php
/**
 * Created by PhpStorm.
 * User: hmjm
 * Date: 03.08.2019
 * Time: 11:18
 */


/**
 * Write a function to print out a boolean array (as in the simple output) as a grid with ​n ​ columns of zeros and ones.
 *
 * The function takes arguments or generates them itself.
 *
 * @var $c - count column (int).
 * @var $l - count lines  (int).
 * @var $output - boolean massive (array).
 */

function bl_ar( $c = 9, $l = 9 ) {

	if ( ! is_numeric( $c ) ) {
		$arr_col = random_int( 4, 9 );
	} else {
		$arr_col = $c;
	}

	if ( ! is_numeric( $l ) ) {
		$arr_ln = random_int( 4, 9 );
	} else {
		$arr_ln = $l;
	}

	for ( $i = 0; $i <= $arr_col; $i ++ ) {
		$output[ $i ] = array_map( function ( $j ) {
			return $j & 1;
		}, range( 1, $arr_ln ) );
	}

	foreach ( $output as $key => $value ) {
		foreach ( $value as $val ) {
			echo $val;
		}
		echo '</br>';
	}
}

bl_ar();


$json = '{
  "people": [
    {
      "name": "Jessy",
      "havePet": [
        "1",
        "2",
        "3"
      ]
    },
    {
      "name": "Billy",
      "havePet": [
        "2",
        "4"
      ]
    },
    {
      "name": "Jimmy",
      "havePet": [
        "1"
      ]
    }
  ],
  "pets": [
    {
      "id": "1",
      "type": "dog",
      "name": "snoppy",
      "can_sit" : "1",
      "noise" : "bark"
    },
    {
      "id": "2",
      "type": "cat",
      "name": "lysiya",
      "can_sit" : "1",
      "noise" : "meow"
    },
    {
      "id": "3",
      "type": "dog",
      "name": "tayson",
      "can_sit" : "1",
      "noise" : "bark"
    },
    {
      "id": "4",
      "type": "bird",
      "name": "",
      "can_sit" : "0",
      "noise" : "tweet"
    }
  ]
}';

$jsonDec = json_decode( $json );

/**
 * Write classes per following requirements, and implementation can be just “echo”.
 *
 */


/**
 * @class People
 * @var $jsonDec - (object).
 * @return object peoples data
 */
class People {

	public function __construct() {
		global $jsonDec;
		$this->people = $jsonDec->people;
	}

}


/**
 * @class Pets
 * @var $jsonDec - (object).
 * @return object pets data
 */
class Pets {

	public function __construct() {
		global $jsonDec;
		$this->pets = $jsonDec->pets;
	}

}

$People = new People();
$Pets   = new Pets();

/**
 * @class test_rule
 * @var $People - (object).
 * @var $Pets - (object).
 *
 */
class test_rule {

	/**
	 * @function PetsHaveName
	 * @var $k - key(int).
	 * @var $pet - value(object).
	 * name check
	 */
	public function PetsHaveName() {
		global $Pets;
		foreach ( $Pets->pets as $k => $pet ) {
			if ( $pet->name != '' ) {
				echo 'Pet #' . $pet->id . ' have name: ' . $pet->name;
			} else {
				echo 'Pet #' . $pet->id . ' no name or incognito!';
			}
			echo '</br>';
		}
	}

	/**
	 * @function PetsCanSit
	 * @var $k - key(int).
	 * @var $pet - value(object).
	 * sit check
	 */
	public function PetsCanSit() {
		global $Pets;
		foreach ( $Pets->pets as $k => $pet ) {
			if ( $pet->can_sit == '1' ) {
				echo $pet->type . ' ' . $pet->name . ' can sit!';
			} else {
				echo $pet->type . ' ' . $pet->name . ' can not sit!';
			}
			echo '</br>';
		}
	}

	/**
	 * @function PetsCanNoise
	 * @var $k - key(int).
	 * @var $pet - value(object).
	 * Noise check
	 */
	public function PetsCanNoise() {
		global $Pets;
		foreach ( $Pets->pets as $k => $pet ) {
			if ( $pet->type == 'dog' or $pet->type == 'cat' ) {
				if ( $pet->noise != '' ) {
					echo $pet->type . ' ' . $pet->name . ' can make: ' . $pet->noise;
				} else {
					echo $pet->type . ' ' . $pet->name . ' can not noise!';
				}
			} else {
				echo 'this is not a dog or a cat! this - ' . $pet->type;
				if ( $pet->noise != '' ) {
					echo ' can make: ' . $pet->noise;
				} else {
					echo ' can not noise!';
				}
			}
			echo '</br>';
		}
	}

	/**
	 * @function PersonCanOwn
	 * @var $key - key(int).
	 * @var $person - value(object).
	 * @var $k - key(int).
	 * @var $pet - value(object).
	 * Person have pets check
	 */
	public function PersonCanOwn() {
		global $Pets;
		global $People;
		foreach ( $People->people as $key => $person ) {
			echo $person->name . ' have pet: ';
			echo '</br>';
			foreach ( $Pets->pets as $k => $pet ) {
				if ( is_array( $person->havePet ) && $person->havePet != [] ) {
					if ( in_array( $pet->id, $person->havePet ) ) {
						echo $pet->type . ' - ' . $pet->name;
						echo '</br>';
					}
				} else {
					echo 'No have pets!';
				}
			}
			echo '</br>';
		}
	}

}

$test_rule = new test_rule();
echo '------------------';
print '<pre>';
$test_rule->PetsHaveName();
print '</pre>';
print '<pre>';
$test_rule->PetsCanSit();
print '</pre>';
print '<pre>';
$test_rule->PetsCanNoise();
print '</pre>';
print '<pre>';
$test_rule->PersonCanOwn();
print '</pre>';
echo '------------------';
