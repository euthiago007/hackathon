<?php
require_once 'auth_check.php';
require_once '../service/VagaService.php';

$id        = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$empresaId = (int) $_SESSION['empresa_id'];

if ($id > 0) {
    $service = new VagaService();
    $vaga    = $service->buscarPorId($id);
    // Só exclui se a vaga pertence à empresa logada
    if ($vaga && $vaga->getEmpresaId() === $empresaId) {
        $service->excluir($id);
    }
}

header('Location: minhas-vagas.php');
exit;
