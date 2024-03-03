<?php

it('shows the association page', function () {
    $this->get(route('association'))->assertStatus(200);
});
