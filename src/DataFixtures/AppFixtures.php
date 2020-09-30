<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Image;
use App\Entity\Video;
use App\Entity\Tricks;
use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    /**
    * @var UserPasswordEncoderInterface
    */
    private $passwordEncoder;
    
    /**
    * AppFixture constructor.
    * @param UserPasswordEncoderInterface $passwordEncoder
    */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
            $this->passwordEncoder = $passwordEncoder;
    }
    
    public function load(ObjectManager $manager)
    {
        //User
        $user = new User();
        $user->setEmail('Example@test.fr');
        $user->setAvatar('tailslide.jpg');
        $user->setPassword(
            $this->passwordEncoder->encodePassword($user,
                '123456'
            )
        );
        
        $user->setIsVerified(1);
        $manager->persist($user);

        //Category
        $grabs = new Category();
        $rotations = new Category();
        $flips = new Category();

        $grabs->setTitle('Grabs');
        $rotations->setTitle('rotations');
        $flips->setTitle('flips');
        
        $manager->persist($grabs);
        $manager->persist($rotations);
        $manager->persist($flips);

        $manager->flush();

        //Tricks
        $image = new Image();
        $video = new Video();

        $mute = new Tricks();
        $mute->setUserId($user);
        $mute->setName("Mute");
        $mute->setDescription("Saisie de la carre frontside de la planche entre les deux pieds avec la main avant.");
        $mute->setImage("nose-grab.jpg");
        $mute->setCreatedAt(new \DateTime('now'));
        $mute->setCategoryId($rotations);
        
        $image->setName('tailslide.jpg');
        $video->setUrl("https://www.youtube.com/embed/OparOr70iu0");
        
        $mute->addImage($image);
        $mute->addVideo($video);
        //
        $image = new Image();
        $video = new Video();

        $sade = new Tricks();
        $sade->setUserId($user);
        $sade->setName("Sade");
        $sade->setDescription( "Saisie de la carre backside de la planche, entre les deux pieds, avec la main avant.");
        $sade->setImage("rodeo-1.jpg");
        $sade->setCreatedAt(new \DateTime('now'));
        $sade->setCategoryId($rotations);
        
        $image->setName('stalefish-1.jpg');
        $video->setUrl("https://www.youtube.com/embed/OparOr70iu0");
        
        $sade->addImage($image);
        $sade->addVideo($video);
        //
        $image = new Image();
        $video = new Video();

        $indy = new Tricks();
        $indy->setUserId($user);
        $indy->setName("Indy");
        $indy->setDescription("Saisie de la carre frontside de la planche, entre les deux pieds, avec la main arrière.");
        $indy->setImage("nose-grab-3.jpg");
        $indy->setCreatedAt(new \DateTime('now'));
        $indy->setCategoryId($rotations);

        $image->setName('stalefish-1.jpg');
        $video->setUrl("https://www.youtube.com/embed/OparOr70iu0");

        $indy->addImage($image);
        $indy->addVideo($video);
        //
        $image = new Image();
        $video = new Video();

        $stalefish = new Tricks();
        $stalefish->setUserId($user);
        $stalefish->setName("Stalefish");
        $stalefish->setDescription("Saisie de la carre backside de la planche entre les deux pieds avec la main arrière.");
        $stalefish->setImage("frontflip-2.jpg");
        $stalefish->setCreatedAt(new \DateTime('now'));
        $stalefish->setCategoryId($grabs);

        $image->setName('frontflip.jpg');
        $video->setUrl("https://www.youtube.com/embed/OparOr70iu0");

        $stalefish->addImage($image);
        $stalefish->addVideo($video);        
        //
        $image = new Image();
        $video = new Video();

        $tailGrab = new Tricks();
        $tailGrab->setUserId($user);
        $tailGrab->setName("Tail Grab");
        $tailGrab->setDescription("Saisie de la partie arrière de la planche, avec la main arrière.");
        $tailGrab->setImage("backflip-2.jpg");
        $tailGrab->setCreatedAt(new \DateTime('now'));
        $tailGrab->setCategoryId($grabs);

        $image->setName('rodeo-1.jpg');
        $video->setUrl("https://www.youtube.com/embed/OparOr70iu0");

        $tailGrab->addImage($image);
        $tailGrab->addVideo($video);
        //
        $image = new Image();
        $video = new Video();

        $noseGrab = new Tricks();
        $noseGrab->setUserId($user);
        $noseGrab->setName("Nose Grab");
        $noseGrab->setDescription("Saisie de la partie avant de la planche, avec la main avant.");
        $noseGrab->setImage("default-trick.jpg");
        $noseGrab->setCreatedAt(new \DateTime('now'));
        $noseGrab->setCategoryId($grabs);

        $image->setName('rodeo-1.jpg');
        $video->setUrl("https://www.youtube.com/embed/OparOr70iu0");

        $noseGrab->addImage($image);
        $noseGrab->addVideo($video);
        //
        $image = new Image();
        $video = new Video();

        $r180 = new Tricks();
        $r180->setUserId($user);
        $r180->setName("180°");
        $r180->setDescription("Rotation de la planche à 180°.");
        $r180->setImage("stalefish-2.jpg");
        $r180->setCreatedAt(new \DateTime('now'));
        $r180->setCategoryId($grabs);

        $image->setName('cork-1.jpg');
        $video->setUrl("https://www.youtube.com/embed/OparOr70iu0");

        $r180->addImage($image);
        $r180->addVideo($video);
        //
        $image = new Image();
        $video = new Video();

        $r360 = new Tricks();
        $r360->setUserId($user);
        $r360->setName("360°");
        $r360->setDescription("Rotation de la planche à 360°.");
        $r360->setImage("cork-1.jpg");
        $r360->setCreatedAt(new \DateTime('now'));
        $r360->setCategoryId($grabs);

        $image->setName('stalefish-2.jpg');
        $video->setUrl("https://www.youtube.com/embed/OparOr70iu0");

        $r180->addImage($image);
        $r180->addVideo($video);
        //
        $image = new Image();
        $video = new Video();

        $r540 = new Tricks();
        $r540->setUserId($user);
        $r540->setName("540°");
        $r540->setDescription("Rotation de la planche à 540°.");
        $r540->setImage("nose-grab-1.jpg");
        $r540->setCreatedAt(new \DateTime('now'));
        $r540->setCategoryId($grabs);

        $image->setName('stalefish-2.jpg');
        $video->setUrl("https://www.youtube.com/embed/OparOr70iu0");

        $r540->addImage($image);
        $r540->addVideo($video);
        //
        $image = new Image();
        $video = new Video();

        $r720 = new Tricks();
        $r720->setUserId($user);
        $r720->setName("720°");
        $r720->setDescription("Rotation de la planche à 720°.");
        $r720->setImage('nose-grab-2.jpg');
        $r720->setCreatedAt(new \DateTime('now'));
        $r720->setCategoryId($grabs);

        $image->setName("cork-1.jpg");
        $video->setUrl("https://www.youtube.com/embed/OparOr70iu0");

        $r720->addVideo($video);
        $r720->addImage($image);

        $manager->persist($mute);
        $manager->persist($sade);
        $manager->persist($indy);
        $manager->persist($stalefish);
        $manager->persist($tailGrab);
        $manager->persist($noseGrab);
        $manager->persist($r180);
        $manager->persist($r360);
        $manager->persist($r540);
        $manager->persist($r720);

        $manager->flush();
    }
}
