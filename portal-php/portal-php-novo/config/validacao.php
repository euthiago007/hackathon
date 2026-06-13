<?php

class Validacao
{
    private array $erros = [];

    public function obrigatorio(string $campo, string $valor, string $label): self
    {
        if (trim($valor) === '') {
            $this->erros[] = "O campo \"$label\" é obrigatório.";
        }
        return $this;
    }

    public function minimo(string $campo, string $valor, int $min, string $label): self
    {
        if (strlen(trim($valor)) > 0 && strlen(trim($valor)) < $min) {
            $this->erros[] = "\"$label\" deve ter pelo menos $min caracteres.";
        }
        return $this;
    }

    public function email(string $campo, string $valor, string $label): self
    {
        if (trim($valor) !== '' && !filter_var($valor, FILTER_VALIDATE_EMAIL)) {
            $this->erros[] = "\"$label\" não é um e-mail válido.";
        }
        return $this;
    }

    public function numeroPositivo(string $campo, string $valor, string $label): self
    {
        if (trim($valor) !== '' && (!is_numeric($valor) || (float)$valor < 0)) {
            $this->erros[] = "\"$label\" deve ser um número positivo.";
        }
        return $this;
    }

    public function cnpj(string $campo, string $valor, string $label): self
    {
        $cnpj = preg_replace('/[^0-9]/', '', $valor);
        if (trim($valor) !== '' && strlen($cnpj) !== 14) {
            $this->erros[] = "\"$label\" deve ter 14 dígitos numéricos.";
        }
        return $this;
    }

    public function valido(): bool
    {
        return empty($this->erros);
    }

    public function getErros(): array
    {
        return $this->erros;
    }

    public function getMensagem(): string
    {
        return implode('<br>', $this->erros);
    }
}
