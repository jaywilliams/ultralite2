<?php
/**
 * Post
 * 
 * Loads the specified post, and can navigate forwards and backwards by posts.
 * It can also load any sub-classes on demand. e.g. $post->comments == new Post_Comments
 *
 * @package Pixelpost
 * @author Jay Williams
 */

class Post
{
	
	private $prev;
	private $next;

	public function __construct($id)
	{
		return $this->request($id);
	}

	/**
	 * Check if property or sub-class exists
	 */
	public function __isset($property)
	{
		$class_name = __CLASS__ . '_' . ucfirst($property);
		
		// var_dump("ISSET: $class_name");
		
		if (isset($this->$property))
			return true;
		elseif (class_exists($class_name))
			return true;
		else
			return false;
	}

	/**
	 * Load sub-class, on request
	 */
	public function __get($property)
	{
		$class_name = __CLASS__ . '_' . ucfirst($property);
		
		// var_dump("GET: $class_name");
		
		if (class_exists($class_name))
			return new $class_name($this->id);
		
		// Return an empty placeholder, if no class exists
		return new Void;
	}
	
	public function request($id=null)
	{
		if (empty($id))
		{
			// Query Database
			// Load the default (latest) post
		}
		elseif(is_numeric($id))
		{
			// Query Database
			// Load the specified post_id
		}
		else
		{
			// Query Databse
			// Load the specific post_slug
		}
		
		// Example database result:
		$this->id             = (int) $id;
		$this->author         = 1;
		$this->author_name    = 'Jay Williams';
		$this->published      = 1;

		$this->title          = 'The name of a book, composition, or other artistic work';
		$this->description    = 'A spoken or written representation or account of a person, object, or event : people who had seen him were able to give a description.
		- the action of giving such a representation or account : teaching by demonstration and description.';

		$this->slug           = 'my-post-title';
		$this->url            = 'http://localhost/ultralite2/post/'.$this->id;

		$this->date           = 'January 5, 2010 3:55 pm'; // Formatted Date
		$this->date_raw       = '2010-01-05 15:55:22 GMT'; // Raw Date
		$this->date_timestamp = '1262706922'; // Raw Unixtime

		// Image Sizes
		$this->caption        = 'A title or brief explanation appended to an article, illustration, cartoon, or poster.';
		$this->photo_t        = 'http://farm3.static.flickr.com/2768/4150163278_df06c69e2b_t.jpg';
		$this->height_t       = 75;
		$this->width_t        = 100;
		$this->photo          = 'http://farm3.static.flickr.com/2768/4150163278_df06c69e2b.jpg';
		$this->height         = 373;
		$this->width          = 500;
	}

	/**
	 * Fetch a single Post
	 */
	public function get($id)
	{
		return new self($id);
	}

	/**
	 * Fetch the Next Post
	 */
	public function next()
	{
		// Rough, prototype code, the final code
		// will find the next post by publish date
		$id = $this->id + 1;
		
		if(is_object($this->next))
			return $this->next;
		
		$this->next = new self($id);
		
		return $this->next;
	}
	
	/**
	 * Fetch the Previous Post
	 */
	public function prev()
	{
		// Rough, prototype code, the final code
		// will find the next post by publish date
		$id = $this->id - 1;
		
		if(is_object($this->prev))
			return $this->prev;
		
		$this->prev = new self($id);
		
		return $this->prev;
	}
	
	/**
	 * Alias for prev()
	 */
	public function previous()
	{
		return $this->prev();
	}

} //endclass
