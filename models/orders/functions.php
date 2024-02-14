<?php

function insertOrder($idUser, $totalAmount)
{
  global $conn;

  try {
    $query = "INSERT INTO customer_order (idUser, totalAmount, orderStatus, orderedAt) VALUES (?, ?, ?, ?)";
    $order = $conn->prepare($query);
    $orderedAt = date("Y-m-d H:i:s");
    return $order->execute([$idUser, $totalAmount, 'in preparation', $orderedAt]);
  } catch (PDOException $ex) {
    recordErrors($ex->getMessage());
  }
}

function insertOrderItems($obj, $idOrder)
{
  global $conn;

  try {
    $values = [];
    $params = [];

    foreach ($obj as $item) {
      $params[] = "(?, ?, ?, ?)";

      $values[] = $idOrder;
      $values[] = $item["id"];
      $values[] = $item["quantity"];
      $values[] = $item["price"];
    }

    $query = "INSERT INTO order_items (idOrder, idArticle, quantity, price) VALUES " . implode(",", $params);
    $items = $conn->prepare($query);

    return $items->execute($values);
  } catch (PDOException $ex) {
    recordErrors($ex->getMessage());
  }
}

function getAllOrders()
{
  try {
    return executeQuery("SELECT * FROM customer_order AS co INNER JOIN user AS u ON co.idUser = u.idUser");
  } catch (PDOException $ex) {
    recordErrors($ex->getMessage());
  }
}

function getOrderDetails($id)
{
  global $conn;

  try {
    $query = "SELECT oi.idArticle, oi.idOrder, oi.quantity, oi.price, a.idArticle, a.name, a.description, a.newImage, a.alt, co.idOrder, co.idUser, co.totalAmount, co.orderStatus, u.idUser, u.firstName, u.lastName 
    FROM order_items AS oi 
    JOIN article AS a 
    ON oi.idArticle = a.idArticle 
    JOIN customer_order AS co 
    ON co.idOrder = oi.idOrder 
    JOIN user AS u 
    ON co.idUser = u.idUser
    WHERE co.idOrder = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$id]);
    return $stmt->fetchAll();
  } catch (PDOException $ex) {
    recordErrors($ex->getMessage());
  }
}

function deleteOrderDetails($id)
{
  global $conn;

  try {
    $query = "DELETE FROM order_items WHERE idOrder = ?";
    $stmt = $conn->prepare($query);
    return $stmt->execute([$id]);
  } catch (PDOException $ex) {
    recordErrors($ex->getMessage());
  }
}

function deleteOrder($id)
{
  global $conn;

  try {
    $query = "DELETE FROM customer_order WHERE idOrder = ?";
    $stmt = $conn->prepare($query);
    return $stmt->execute([$id]);
  } catch (PDOException $ex) {
    recordErrors($ex->getMessage());
  }
}

function countOrders()
{
  global $conn;

  try {
    return $conn->query("SELECT COUNT(*) AS ordersCount FROM customer_order")->fetch();
  } catch (PDOException $ex) {
    recordErrors($ex->getMessage());
  }
}

function updateOrderStatus($id, $status)
{
  global $conn;

  try {
    $query = "UPDATE customer_order SET orderStatus = ? WHERE idOrder = ?";
    $stmt = $conn->prepare($query);
    return $stmt->execute([$status, $id]);
  } catch (PDOException $ex) {
    recordErrors($ex->getMessage());
  }
}
