<?php
    interface Deleter {
        public function del(array $ids, string $table);
    }
?>