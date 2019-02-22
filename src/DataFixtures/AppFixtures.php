<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\Task;


class AppFixtures extends Fixture
{
  public function load(ObjectManager $manager)
  {
    $users = [
    "aa" => ["username"=>"aa", "email"=>"aa@aa.aa", "password"=>"aa"],
    "bb" =>  ["username"=>"bb", "email"=>"bb@bb.bb", "password"=>"bb"]
    ];

    $tasks =[
      "t1" => ["title"=>"Arroser les plantes", "comments"=> "Attention a ne pas mélanger les engrais", "frequency_choice" => "jour", "frequency" => 1 ],
      "t2" =>["title"=>"Arroser les plantes2", "comments"=> "Attention a ne pas mélanger les engrais2", "frequency_choice" => "mois", "frequency" => 2 ],
      "t3" =>["title"=>"Arroser les plantes3", "comments"=> "Attention a ne pas mélanger les engrais3", "frequency_choice" => "annee", "frequency" => 3 ],
    ];

/* User */
$user1 =new User();
$user1->setUsername($users['aa']["username"]);
$user1->setEmail($users['aa']["email"]);
$user1->setPlainPassword($users['aa']['password']);
$user1->setEnabled(1);

$manager->persist($user1);

$user2 =new User();
$user2->setUsername($users['bb']["username"]);
$user2->setEmail($users['bb']["email"]);
$user2->setPlainPassword($users['bb']['password']);
$user2->setEnabled(1);

$manager->persist($user2);

/* Task */

$task = new Task();
$task->setTitle($tasks['t1']["title"]);
$task->setComments($tasks['t1']["comments"]);
$task->setFrequencyChoice($tasks['t1']["frequency_choice"]);
$task->setFrequency($tasks['t1']["frequency"]);
$task->setDate( new \DateTime());
$task->addUser($user1);

$manager->persist($task);


$task = new Task();
$task->setTitle($tasks['t3']["title"]);
$task->setComments($tasks['t3']["comments"]);
$task->setFrequencyChoice($tasks['t3']["frequency_choice"]);
$task->setFrequency($tasks['t3']["frequency"]);
$task->setDate( new \DateTime());
$task->addUser($user2);

$manager->persist($task);



$task = new Task();
$task->setTitle($tasks['t2']["title"]);
$task->setComments($tasks['t2']["comments"]);
$task->setFrequencyChoice($tasks['t2']["frequency_choice"]);
$task->setFrequency($tasks['t2']["frequency"]);
$task->setDate( new \DateTime());
$task->addUser($user1);
$task->addUser($user2);

$manager->persist($task);


$manager->flush();

  
  }
}
