<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;

class OrderController extends Controller
{
    public function index(Request $request)
{
    $user = $request->user();
    $orders = Order::with(['orderItems.book'])
                    ->where('user_id', $user->id)
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);

    $formattedOrders = $orders->map(function ($order, $index) {
        return [
            'serial_number' => $index + 1,
            'order_id' => $order->id,
            'total_points' => $order->total_points,
            'created_at' => $order->created_at,
            'items' => $order->orderItems->map(function ($item) {
                return [
                    'book_name' => $item->book->title,
                    'book_price' => $item->subtotal_points,
                ];
            }),
        ];
    });

    return response()->json(['orders' => $formattedOrders], 200);
}

    public function buy(Request $request)
    {
        $user = $request->user();
        $totalPoints = $request->input('total_points');
        $books = $request->input('books');

        if ($user->points < $totalPoints) {
            return response()->json(['message' => 'Not enough points to Buy'], 403);
        }

        $order = new Order([
            'user_id' => $user->id,
            'total_points' => $totalPoints,
        ]);
        $order->save();

        foreach ($books as $book) {
            $orderItem = new OrderItem([
                'order_id' => $order->id,
                'book_id' => $book['id'],
                'quantity' => $book['quantity'],
                'subtotal_points' => $book['subtotal_points'],
            ]);
            $orderItem->save();
        }

        $user->points -= $totalPoints;
        $user->save();

        return response()->json(['message' => 'Order placed successfully'], 201);
    }

    public function cancel(Request $request, $id)
    {
        $user = $request->user();
        $order = Order::findOrFail($id);

        if ($order->user_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $user->points += $order->total_points;
        $user->save();

        $order->orderItems()->delete();
        $order->delete();

        return response()->json(['message' => 'Order cancelled successfully'], 200);
    }
}
