<?php

namespace App\entities;

class Usuario
{
    private int $id;
    private string $nome;
    private string $email;
    private string $senha;
    private \DateTime $dtCadastro;
    private \DateTime $dtAlteracao;


    public function __construct(string $nome, string $email, string $senha)
    {
        $this->setNome($nome);
        $this->setEmail($email);
        $this->setSenha($senha);
        $this->dtCadastro = new \DateTime();
        $this->dtAlteracao = new \DateTime();
    }


    public function getId(): int
    {
        return $this->id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getSenha(): string
    {
        return $this->senha;
    }

    public function getDtCadastro(): \DateTime
    {
        return $this->dtCadastro;
    }

    public function getDtAlteracao(): \DateTime
    {
        return $this->dtAlteracao;
    }


    public function setNome(string $nome): void
    {
        if (empty($nome)) {
            throw new \InvalidArgumentException("O nome não pode ser vazio.");
        }
        $this->nome = $nome;
        $this->atualizarDtAlteracao();
    }

    public function setEmail(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException("E-mail inválido.");
        }
        $this->email = $email;
        $this->atualizarDtAlteracao();
    }

    public function setSenha(string $senha): void
    {
        if (strlen($senha) < 6) {
            throw new \InvalidArgumentException("A senha deve ter pelo menos 6 caracteres.");
        }
        $this->senha = password_hash($senha, PASSWORD_BCRYPT);
        $this->atualizarDtAlteracao();
    }


    private function atualizarDtAlteracao(): void
    {
        $this->dtAlteracao = new \DateTime();
    }


    // public function getById($id){
    //     $sql = new db();

    // }
}
