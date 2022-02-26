<?php


test('canStart returns false if now is before the start time');
test('canStart returns false if now is after the end time');
test('canStart returns true if now is after the start time and before the end time');
test('canStart returns false if a group member has already begun the task');
test('canStart returns false if the task has already been started');
test('canStart returns false if the user is not on the same track');
test('canStart returns true if the user is on the correct track');
test('canStart returns false if all group members are not on the same track');

