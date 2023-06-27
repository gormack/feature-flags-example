<?php

use Gormack\FeatureFlags\{
    Environment,
    Id,
    Segment,
    User,
    Attribute,
    Type
};

require 'vendor/autoload.php';

$prod = new Environment(Id::new(), 'Production');
$uat = new Environment(Id::new(), 'UAT');
$kenny = new Environment(Id::new(), 'Kenny');
$local = new Environment(Id::new(), 'Local');

$userId = new Id(3930432);
$user = new User(
    $userId,
    [
        new Attribute(Id::new(), Type::Boolean, 'isInternal', true),
        new Attribute(Id::new(), Type::Boolean, 'isTrial', false),
        new Attribute(Id::new(), Type::String, 'plan', 'converting'),
        new Attribute(Id::new(), Type::Integer, 'accountId', $userId),
    ]
);

$scammerId = Id::new();
$scammer = new User(
    $scammerId,
    [
        new Attribute(Id::new(), Type::Boolean, 'isInternal', false),
        new Attribute(Id::new(), Type::Boolean, 'isTrial', false),
        new Attribute(Id::new(), Type::String, 'plan', 'building'),
        new Attribute(Id::new(), Type::Integer, 'accountId', $scammerId),
    ]
);

$trialSegment = new Segment(Id::new(), 'Trial users', 'Hand picked users on a trial', [$user]);
$allUsers = new Segment(Id::new(), 'Everyone', 'All users', [$user, $scammer]);
var_dump($trialSegment, $allUsers);
