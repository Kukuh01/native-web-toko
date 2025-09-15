<?php

require_once __DIR__.'/db.php';

function get_all_items() {
    $pdo = DB::get();
    $stmt = $pdo->query('SELECT * FROM items ORDER BY id DESC');
    return $stmt->fetchAll();
}

function get_item($id) {
    $pdo = DB::get();
    $stmt = $pdo->prepare('SELECT * FROM items WHERE id = :id LIMIT 1');
    $stmt->execute(['id' => $id]);
    return $stmt->fetch();
}

/**
 * Membuat item baru
 * @param string $name
 * @param string $desc
 * @param float $price
 * @param string|null $image nama file gambar (nullable)
 */
function create_item($name, $desc, $price, $image = null) {
    $pdo = DB::get();
    $stmt = $pdo->prepare(
        'INSERT INTO items (name, description, price, image)
         VALUES (:name, :desc, :price, :image)'
    );
    return $stmt->execute([
        'name'  => $name,
        'desc'  => $desc,
        'price' => $price,
        'image' => $image
    ]);
}

/**
 * Update item.
 * Jika $image null, maka kolom image tidak diubah.
 */
function update_item($id, $name, $desc, $price, $image = null) {
    $pdo = DB::get();

    if ($image !== null && $image !== '') {
        $stmt = $pdo->prepare(
            'UPDATE items 
             SET name = :name, description = :desc, price = :price, image = :image 
             WHERE id = :id'
        );
        return $stmt->execute([
            'id'    => $id,
            'name'  => $name,
            'desc'  => $desc,
            'price' => $price,
            'image' => $image
        ]);
    } else {
        $stmt = $pdo->prepare(
            'UPDATE items 
             SET name = :name, description = :desc, price = :price 
             WHERE id = :id'
        );
        return $stmt->execute([
            'id'    => $id,
            'name'  => $name,
            'desc'  => $desc,
            'price' => $price
        ]);
    }
}

function delete_item($id) {
    $pdo = DB::get();
    $stmt = $pdo->prepare('DELETE FROM items WHERE id = :id');
    return $stmt->execute(['id'=>$id]);
}