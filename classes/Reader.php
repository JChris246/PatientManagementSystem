<?php
    interface Reader {
        public function find(array $id, string $table): array;
        public function findAll(array $ids): array;
        public function findAllLimit(array $id, string $offset, string $range): array;
        public function count(string $table): array;
    }
?>