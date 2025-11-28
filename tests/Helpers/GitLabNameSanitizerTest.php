<?php

namespace Tests\Helpers;

use App\Helpers\GitLabNameSanitizer;
use function PHPUnit\Framework\assertEquals;

test('fixes uppercase name', function () {
    $name = "BadGroupNAME";
    $sanitized = GitLabNameSanitizer::sanitize($name);

    assertEquals($sanitized, "badgroupname");
});

test('removes accents from letters', function () {
    $name = "äccëntédgróúpnámë";
    $sanitized = GitLabNameSanitizer::sanitize($name);

    assertEquals($sanitized, "accentedgroupname");
});

test('removes illegal start characters', function () {
    $name = "-badgroupname";
    $sanitized = GitLabNameSanitizer::sanitize($name);

    assertEquals($sanitized, "badgroupname");
    $name = "_badgroupname";
    $sanitized = GitLabNameSanitizer::sanitize($name);

    assertEquals($sanitized, "badgroupname");
    $name = ".badgroupname";
    $sanitized = GitLabNameSanitizer::sanitize($name);

    assertEquals($sanitized, "badgroupname");
});

test('removes illegal end characters', function () {
    $name = "badgroupname-";
    $sanitized = GitLabNameSanitizer::sanitize($name);

    assertEquals($sanitized, "badgroupname");
    $name = "badgroupname_";
    $sanitized = GitLabNameSanitizer::sanitize($name);

    assertEquals($sanitized, "badgroupname");
    $name = "badgroupname.";
    $sanitized = GitLabNameSanitizer::sanitize($name);

    assertEquals($sanitized, "badgroupname");
});

test('removes illegal suffixes', function () {
    $name = "badgroupname.git";
    $sanitized = GitLabNameSanitizer::sanitize($name);

    assertEquals($sanitized, "badgroupname");
    $name = "badgroupname.atom";
    $sanitized = GitLabNameSanitizer::sanitize($name);

    assertEquals($sanitized, "badgroupname");
});

test('replaces double dashes with single dash', function () {
    $name = "bad--group--name";
    $sanitized = GitLabNameSanitizer::sanitize($name);

    assertEquals($sanitized, "bad-group-name");
});

test('does not remove illegal start/end characters from the middle of a name', function () {
    $name = "good-group_name.yes";
    $sanitized = GitLabNameSanitizer::sanitize($name);

    assertEquals($sanitized, "good-group_name.yes");
});
