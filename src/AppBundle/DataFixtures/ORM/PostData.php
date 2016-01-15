<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Comment;
use AppBundle\Entity\DictionaryItem;
use AppBundle\Entity\Person;
use AppBundle\Entity\Post;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class PostData implements FixtureInterface
{
    private $admin;
    private $commentRole;
    private $newsCategory;

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->admin = new DictionaryItem('ROLE_ADMIN', 'admin');
        $this->commentRole = new DictionaryItem('ROLE_COMMENT', 'comment');
        $this->newsCategory = new DictionaryItem('CATEGORY_NEWS', 'news');

        $manager->persist($this->admin);
        $manager->persist($this->commentRole);
        $manager->persist($this->newsCategory);

        $this->loadBunch($manager);
    }

    public function loadBunch(ObjectManager $manager)
    {

        $author = new Person('author', $this->admin);

        for ($i = 0; $i < 400; $i++) {
            $post = new Post('foo', 'bar', $author, $this->newsCategory);
            $comments = array();
            for ($j = 0; $j < 10; $j++) {
                $comments[] = new Comment('foo', 'bar', new Person('comment author '.$i.'.'.$j, $this->commentRole), $post);
            }
            $post->setComments($comments);
            $manager->persist($post);
        }

        $manager->flush();
    }
}