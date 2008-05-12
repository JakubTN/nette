<?php

/**
 * Nette Framework
 *
 * Copyright (c) 2004, 2008 David Grudl (http://davidgrudl.com)
 *
 * This source file is subject to the "Nette license" that is bundled
 * with this package in the file license.txt.
 *
 * For more information please see http://nettephp.com/
 *
 * @copyright  Copyright (c) 2004, 2008 David Grudl
 * @license    http://nettephp.com/license  Nette license
 * @link       http://nettephp.com/
 * @category   Nette
 * @package    Nette::Collections
 */

/*namespace Nette::Collections;*/



require_once dirname(__FILE__) . '/../Collections/Collection.php';

require_once dirname(__FILE__) . '/../Collections/IList.php';



/**
 * Provides the base class for a generic list (items can be accessed by index).
 *
 * @author     David Grudl
 * @copyright  Copyright (c) 2004, 2008 David Grudl
 * @package    Nette::Collections
 * @version    $Revision$ $Date$
 */
class ArrayList extends Collection implements IList
{
	/** @var int */
	protected $base = 0;


	/**
	 * Inserts the specified element at the specified position in this list.
	 * @param  int
	 * @param  mixed
	 * @return bool
	 * @throws ::ArgumentOutOfRangeException
	 */
	public function insertAt($index, $item)
	{
		$index -= $this->base;
		if ($index < 0 || $index > count($this->data)) {
			throw new /*::*/ArgumentOutOfRangeException;
		}

		$this->beforeAdd($item);
		array_splice($this->data, (int) $index, 0, array($item));
		return TRUE;
	}



	/**
	 * Removes the first occurrence of the specified element.
	 * @param  mixed
	 * @return bool  true if this list changed as a result of the call
	 * @throws ::NotSupportedException
	 */
	public function remove($item)
	{
		$this->beforeRemove();

		$index = $this->search($item);
		if ($index === FALSE) {
			return FALSE;
		} else {
			array_splice($this->data, $index, 1);
			return TRUE;
		}
	}



	/**
	 * Returns the index of the first occurrence of the specified element,.
	 * or FALSE if this list does not contain this element.
	 * @param  mixed
	 * @return int|FALSE
	 */
	public function indexOf($item)
	{
		$index = $this->search($item);
		return $index === FALSE ? FALSE : $this->base + $index;
	}



	/********************* interface ::ArrayAccess ****************d*g**/



	/**
	 * Replaces (or appends) the item (::ArrayAccess implementation).
	 * @param  int index
	 * @param  object
	 * @return void
	 * @throws ::InvalidArgumentException, ::NotSupportedException, ::ArgumentOutOfRangeException
	 */
	public function offsetSet($index, $item)
	{
		$this->beforeAdd($item);

		if ($index === NULL)  { // append
			$this->data[] = $item;

		} else { // replace
			$index -= $this->base;
			if ($index < 0 || $index >= count($this->data)) {
				throw new /*::*/ArgumentOutOfRangeException;
			}
			$this->data[$index] = $item;
		}
	}



	/**
	 * Returns item (::ArrayAccess implementation).
	 * @param  int index
	 * @return mixed
	 * @throws ::ArgumentOutOfRangeException
	 */
	public function offsetGet($index)
	{
		$index -= $this->base;
		if ($index < 0 || $index >= count($this->data)) {
			throw new /*::*/ArgumentOutOfRangeException;
		}

		return $this->data[$index];
	}



	/**
	 * Exists item? (::ArrayAccess implementation).
	 * @param  int index
	 * @return bool
	 */
	public function offsetExists($index)
	{
		$index -= $this->base;
		return $index >= 0 && $index < count($this->data);
	}



	/**
	 * Removes the element at the specified position in this list.
	 * @param  int index
	 * @return void
	 * @throws ::NotSupportedException, ::ArgumentOutOfRangeException
	 */
	public function offsetUnset($index)
	{
		$index -= $this->base;
		if ($index < 0 || $index >= count($this->data)) {
			throw new /*::*/ArgumentOutOfRangeException;
		}

		$this->beforeRemove();
		array_splice($this->data, (int) $index, 1);
	}

}