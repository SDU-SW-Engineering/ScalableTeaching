<?php

it('returns 0% when 0/2 subtasks are complete');
it('returns 50% when 1/2 subtasks are complete');
it('returns 100% when 2/2 subtasks are complete');
it('considers tasks complete when all subtasks are completed');
it('considers tasks complete when the required subtasks completed');
it('considers tasks complete when the percentage threshold is reached');
it('stages');
