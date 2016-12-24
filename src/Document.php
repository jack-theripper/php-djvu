<?php
/**
 * This file is part of the arhitector/php-djvu library.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author    Dmitry Arhitector <dmitry.arhitector@yandex.ru>
 *
 * @license   http://opensource.org/licenses/MIT MIT
 * @copyright Copyright (c) 2016 Dmitry Arhitector <dmitry.arhitector@yandex.ru>
 */
namespace Arhitector\Djvu;

use InvalidArgumentException;
use Zerg\Endian;
use Zerg\FileStream;
use Zerg\StreamInterface;

/**
 * Class Document
 *
 * @package Arhitector\Djvu
 */
class Document
{
	
	/**
	 * @var string The full path to the file.
	 */
	protected $filePath;
	
	/**
	 * @var StreamInterface
	 */
	protected $stream;
	
	/**
	 * Document constructor.
	 *
	 * @param string $filePath
	 *
	 * @throws \Arhitector\Djvu\Exception
	 * @throws \InvalidArgumentException
	 * @throws \Zerg\Exception
	 */
	public function __construct($filePath)
	{
		$this->setFilePath($filePath);
		$this->setStream(new FileStream($this->getFilePath(), Endian::ENDIAN_BIG, FileStream::BUFFER_BYTE));
		
		
	}
	
	/**
	 * Gets the stream value.
	 *
	 * @return \Zerg\StreamInterface
	 */
	public function getStream()
	{
		return $this->stream;
	}
	
	/**
	 * Get full file path.
	 *
	 * @return string
	 */
	public function getFilePath()
	{
		return $this->filePath;
	}
	
	/**
	 * Sets the stream instance.
	 *
	 * @param \Zerg\StreamInterface $stream
	 *
	 * @return Document
	 */
	protected function setStream(StreamInterface $stream)
	{
		$this->stream = $stream;
		
		return $this;
	}
	
	/**
	 * Set file path.
	 *
	 * @param string $filePath
	 *
	 * @return Document
	 * @throws \InvalidArgumentException
	 * @throws Exception
	 */
	protected function setFilePath($filePath)
	{
		if ( ! is_string($filePath))
		{
			throw new InvalidArgumentException('File path must be a string type.');
		}
		
		$filePath = realpath($filePath);
		
		if ( ! is_file($filePath))
		{
			throw new Exception('File path not found.');
		}
		
		$this->filePath = $filePath;
		
		return $this;
	}
	
}