<?php
namespace app\app\controllers;

use PDO;
use FPDF;

class InvoiceController
{
    public function generate(int $orderId)
    {
        $pdo = new PDO(
            "mysql:host=db;dbname=ecommerce_db;charset=utf8mb4",
            "root",
            "44",

        );

        // commande
        $stmt = $pdo->prepare("
            SELECT * FROM orders 
            WHERE id = ? AND user_id = ?
        ");
        $stmt->execute([$orderId, $_SESSION['user_id']]);
        $order = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$order) {
            die('Commande introuvable');
        }

        // produits
        $stmt = $pdo->prepare("
            SELECT oi.*, p.name
            FROM order_items oi
            JOIN products p ON p.id = oi.product_id
            WHERE oi.order_id = ?
        ");
        $stmt->execute([$orderId]);
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',16);

        // Header
        $pdf->Cell(0,10,'FACTURE',0,1,'C');
        $pdf->Ln(5);

        $pdf->SetFont('Arial','',12);
        $pdf->Cell(0,8,'Commande #' . $order['id'],0,1);
        $pdf->Cell(0,8,'Date : ' . $order['created_at'],0,1);
        $pdf->Ln(5);

        // Table header
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(80,8,'Produit',1);
        $pdf->Cell(30,8,'Prix',1);
        $pdf->Cell(30,8,'Quantité',1);
        $pdf->Cell(40,8,'Total',1);
        $pdf->Ln();

        $pdf->SetFont('Arial','',12);

        foreach ($items as $i) {
            $pdf->Cell(80,8,$i['name'],1);
            $pdf->Cell(30,8,$i['price'].' DH',1);
            $pdf->Cell(30,8,$i['quantity'],1);
            $pdf->Cell(40,8,($i['price']*$i['quantity']).' DH',1);
            $pdf->Ln();
        }

        $pdf->Ln(5);
        $pdf->SetFont('Arial','B',14);
        $pdf->Cell(0,10,'Total : '.$order['total'].' DH',0,1,'R');

        $pdf->Output('I','facture_'.$orderId.'.pdf');
    }
}
