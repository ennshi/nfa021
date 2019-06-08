<?php
require_once 'init.php';
require_once 'classes/fpdf.php';
if(!$_SESSION['permission']&&(time()-$_SESSION['auth_time'] > 100000)){
    header('Location: logout.php');
} else if(!$_SESSION['permission']&&(time()-$_SESSION['auth_time'] < 100000)) {
    header('Location: index.php');
}
else {
    $user = new User;
    $userIds = $user->userIds();
    $pdf = new FPDF();
    $pdf->AddPage();
    
    $pdf->SetTextColor(0);
    $pdf->SetFillColor(120,120,120); 
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(20, 15, "Numero", 'LTR', 0, 'C', true);
    $pdf->Cell(50, 15, "Prenom", 'LTR', 0, 'C', true);
    $pdf->Cell(50, 15, "Nom", 'LTR', 0, 'C', true); 
    $pdf->Cell(70, 15, "Email", 'LTR', 1, 'C', true);
    
    $pdf->SetFont('Arial','',12);
    $pdf->SetFillColor(238); 
    $x = 1;
    $sum = count($userIds);
    
    foreach($userIds as $userId){
        $user->find($userId->id);
        $nom = $user->data()->nom;
        $prenom = $user->data()->prenom;
        $email = $user->data()->email;
        $pdf->Cell(20, 15, $x, 'LTR', 0, 'C', true);
        $pdf->Cell(50, 15, $prenom, 'LTR', 0, 'C', true);
        $pdf->Cell(50, 15, $nom, 'LTR', 0, 'C', true);
        $pdf->Cell(70, 15, $email, 'LTR', 1, 'C', true);
        $x++;
    }
    $pdf->Cell(190, 15, "Total users: {$sum}", 1, 0, 'L', true);
    $pdf->Output('Liste_utilisateurs.pdf', 'I');
    
}

