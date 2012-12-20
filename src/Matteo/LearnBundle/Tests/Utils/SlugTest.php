<?php

namespace Matteo\LearnBundle\Tests\Utils;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Matteo\LearnBundle\Utils\Slug;

class SlugTest extends WebTestCase
{
    /*
     * Full Coverage of a Slug Testing
     */
    public function testSlugs()
    {
        // Should replace all the spaces with a '-' and remove the '
        $this->assertEquals(Slug::slugify('Bob\'s blog and "stuff"'), 'bobs-blog-and-stuff');
        // Umlaute replace
        $this->assertEquals(Slug::slugify('Völker ändern über vieles'), 'voelker-aendern-ueber-vieles');
        // Some special characters
        $this->assertEquals(Slug::slugify('A?+"*%B&/()="C'), 'a-b-c');
        
        // Check if it's a slug
        $this->assertTrue(Slug::isSlug('bob-got-everything'));
        $this->assertFalse(Slug::isSlug('Bob got everything!'));
    }
}