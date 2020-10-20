<?php

defined('BASEPATH') OR exit('Caminho Inválido');

class Ordem_servicos_model extends CI_Model{

    public function get_all(){

        $this->db->select([
           
            'ordens_servicos.*',
            'clientes.cliente_id',
            'clientes.cliente_nome',
            'formas_pagamentos.forma_pagamento_id',
            'formas_pagamentos.forma_pagamento_nome as forma_pagamento',
        ]);

        $this->db->join('clientes', 'cliente_id = ordem_servico_cliente_id', 'left');
        $this->db->join('formas_pagamentos', 'forma_pagamento_id = ordem_servico_forma_pagamento_id', 'left');

        return $this->db->get('ordens_servicos')->result();


    }

    public function get_by_id($ordem_servico_id = null){

        $this->db->select([
           
            'ordens_servicos.*',
            'clientes.cliente_id',
            'clientes.cliente_cpf_cnpj',
            'CONCAT (clientes.cliente_nome, " ", clientes.cliente_sobrenome) as  cliente_nome_completo',           
            'formas_pagamentos.forma_pagamento_id',
            'formas_pagamentos.forma_pagamento_nome as forma_pagamento',
        ]);

        $this->db->join('clientes', 'cliente_id = ordem_servico_cliente_id', 'left');
        $this->db->join('formas_pagamentos', 'forma_pagamento_id = ordem_servico_forma_pagamento_id', 'left');

        return $this->db->get('ordens_servicos')->row();


    }

    public function get_all_servicos_by_ordem($ordem_servico_id = null){

        if($ordem_servico_id){

            $this->db->select([
                'ordem_tem_servicos.*',
                'servicos.servico_descricao',
        
            ]);

            $this->db->join('servicos', 'servico_id = ordem_ts_id_servico', 'left');
            $this->db->where('ordem_ts_id_ordem_servico', $ordem_servico_id);
            return $this->db->get('ordem_tem_servicos')->result();

        }
    }

    public function delete_old_services($ordem_servico_id){

        if($ordem_servico_id){
            
            $this->db->delete('ordem_tem_servicos', ['ordem_ts_id_ordem_servico' => $ordem_servico_id]);    
        }
    }
}