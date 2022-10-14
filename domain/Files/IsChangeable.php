<?php

namespace Domain\Files;

interface IsChangeable {

    public function setChanged(bool $isChanged) : void;
}
