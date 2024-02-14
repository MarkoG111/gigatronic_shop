if (window.location.href == BASE_URL + "index.php?page=adminOrders" || window.location.href == BASE_URL + "index.php?page=adminOrders#") {
  $(document).ready(function () {
    $('#footer').css('margin-top', '350px');

    printOrders();

    $("body").on("click", ".details-order", function (e) {
      e.preventDefault();

      let id = $(this).data("id");

      $.ajax({
        url: "models/orders/ajaxGetOrder.php",
        method: "POST",
        dataType: "json",
        data: {
          id: id
        },
        success: function (data) {
          makeOrderDetailsTable(data);
        },
        error: function (xhr, status, statusTxt) {
          console.log(xhr.status);
          console.log(xhr);
        }
      })
    });

    $("body").on("click", ".delete-order", function (e) {
      e.preventDefault();

      let id = $(this).data("id");

      deleteOrder(id);
    });

    $("body").on("change", ".order-status", function () {
      let orderId = $(this).data("order-id");
      let newStatus = $(`.order-status[data-order-id="${orderId}"]`).val();

      updateOrderStatus(orderId, newStatus);
    });
  })

  function printOrders() {
    $.ajax({
      url: "models/orders/ajaxAllOrders.php",
      method: "POST",
      dataType: "json",
      success: function (data) {
        makeOrderTable(data);
      },
      error: function (xhr, status, statusTxt) {
        console.log(xhr.status);
        console.log(xhr);
      }
    })
  }

  function makeOrderTable(orders) {
    let html = `
    <table class='table table-hover table-bordered table-striped table-responsive-sm'>
      <thead>
          <tr>
              <th>Order</th>
              <th>User</th>
              <th>Order Date</th>
              <th>Order Status</th>
              <th>Setup</th>
          </tr>
      </thead>
    <tbody>`

    for (let order of orders) {
      html += `
      <tr>
        <td>${order.idOrder}</td>
        <td>${order.firstName} ${order.lastName}</td>
        <td>${order.orderedAt}</td>
        <td>
          <select class="order-status" data-order-id="${order.idOrder}">
            <option value="not processed" ${order.orderStatus === 'not processed' ? 'selected' : ''}>Not Processed</option>
            <option value="in preparation" ${order.orderStatus === 'in preparation' ? 'selected' : ''}>In Preparation</option>
            <option value="sent" ${order.orderStatus === 'sent' ? 'selected' : ''}>Sent</option>
            <option value="delivered" ${order.orderStatus === 'delivered' ? 'selected' : ''}>Delivered</option>
          </select>
        </td>
        <td>
          <a href='#' data-id='${order.idOrder}' class='btn btn-outline-danger delete-order'>Delete</a>
          <a href='#' data-id='${order.idOrder}' class='btn btn-outline-primary details-order'>Details</a>
        </td>
      </tr>
      `
    }

    $("#order-table").html(html);
  }

  function makeOrderDetailsTable(items) {
    let html = `
    <table class='table table-hover table-bordered table-striped table-responsive-sm'>
      <thead>
        <tr>
          <th>Article</th>
          <th>Description</th>
          <th>Image</th>
          <th>Quantity</th>
          <th>Price</th>
          <th>Total Amount</th>
        </tr>
      </thead>
    <tbody>`

    for (let item of items) {
      html += `
        <tr>
          <td>${item.name}</td>
          <td>${item.description}</td>
          <td><img src='${item.newImage}' alt='${item.alt}' width=100 height=100/></td>
          <td>${item.quantity}</td>
          <td>${item.price} &euro;</td>
          <td>${item.totalAmount} &euro;</td>
        </tr>
      `
    }

    $('#order-details').html(html);
  }

  function updateOrderStatus(orderId, newStatus) {
    $.ajax({
      url: "models/orders/ajaxUpdateOrderStatus.php",
      method: "POST",
      dataType: "json",
      data: {
        id: orderId,
        status: newStatus
      },
      success: function (data) {
        alert("Successfully changed order status");
        makeOrderDetailsTable(data);
      },
      error: function (xhr, status, statusTxt) {
        console.log(xhr.status);
        console.log(xhr);
      }
    });
  }

  function deleteOrder(id) {
    if (confirm("Are you sure you want to delete this order?")) {
      $.ajax({
        url: "models/orders/delete.php",
        method: "POST",
        dataType: "json",
        data: {
          id: id
        },
        success: function () {
          printOrders();
        },
        error: function (xhr, status, statusTxt) {
          console.log(xhr.status)
        }
      })
    }
  }
}