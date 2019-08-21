<?php

declare(strict_types=1);

namespace Joaosalless\Dates\BR;

use Joaosalless\Dates\DatesTest;

class StateHolidaysTest extends DatesTest
{
    const STATE_AC = 'AC';
    const STATE_AL = 'AL';
    const STATE_AP = 'AP';
    const STATE_AM = 'AM';
    const STATE_BA = 'BA';
    const STATE_CE = 'CE';
    const STATE_DF = 'DF';
    const STATE_ES = 'ES';
    const STATE_GO = 'GO';
    const STATE_MA = 'MA';
    const STATE_MT = 'MT';
    const STATE_MS = 'MS';
    const STATE_MG = 'MG';
    const STATE_PA = 'PA';
    const STATE_PB = 'PB';
    const STATE_PR = 'PR';
    const STATE_PE = 'PE';
    const STATE_PI = 'PI';
    const STATE_RJ = 'RJ';
    const STATE_RN = 'RN';
    const STATE_RS = 'RS';
    const STATE_RO = 'RO';
    const STATE_RR = 'RR';
    const STATE_SC = 'SC';
    const STATE_SP = 'SP';
    const STATE_SE = 'SE';
    const STATE_TO = 'TO';

    protected $country = 'BR';

    /**
     * State holidays
     *
     * @return array
     */
    public function eventsProvider(): array
    {
        return [
            // Acre State
            ['2017-01-23', static::STATE_AC, null, ['region' => 'STATE', 'name' => 'Dia do Evangélico']],
            ['2017-03-08', static::STATE_AC, null, ['region' => 'STATE', 'name' => 'Alusivo ao Dia Internacional da Mulher']],
            ['2016-06-15', static::STATE_AC, null, ['region' => 'STATE', 'name' => 'Aniversário do Estado']],
            ['2017-09-05', static::STATE_AC, null, ['region' => 'STATE', 'name' => 'Feriado Estadual']],
            ['2017-11-17', static::STATE_AC, null, ['region' => 'STATE', 'name' => 'Assinatura do Tratado de Petrópolis']],
            // Alagoas State
            ['2017-06-24', static::STATE_AL, null, ['region' => 'STATE', 'name' => 'São João']],
            ['2017-06-29', static::STATE_AL, null, ['region' => 'STATE', 'name' => 'São Pedro']],
            ['2017-09-16', static::STATE_AL, null, ['region' => 'STATE', 'name' => 'Emancipação Política']],
            ['2017-11-20', static::STATE_AL, null, ['region' => 'STATE', 'name' => 'Dia da Consciência Negra']],
            // Amapá State
            ['2017-03-19', static::STATE_AP, null, ['region' => 'STATE', 'name' => 'São José']],
            ['2017-09-13', static::STATE_AP, null, ['region' => 'STATE', 'name' => 'Criação do Território Federal']],
            // Amazonas State
            ['2017-09-05', static::STATE_AM, null, ['region' => 'STATE', 'name' => 'Feriado Estadual']],
            ['2017-11-20', static::STATE_AM, null, ['region' => 'STATE', 'name' => 'Dia da Consciência Negra']],
            // Bahia State
            ['2017-07-02', static::STATE_BA, null, ['region' => 'STATE', 'name' => 'Independência da Bahia']],
            // Ceará State
            ['2017-03-25', static::STATE_CE, null, ['region' => 'STATE', 'name' => 'Data da Abolição da Escravidão no Ceará']],
            // Distrito Federal District
            ['2017-04-21', static::STATE_DF, null, ['region' => 'STATE', 'name' => 'Fundação de Brasília']], // Fundação de Brasília
            ['2017-11-30', static::STATE_DF, null, ['region' => 'STATE', 'name' => 'Dia do Evangélico']],
            // Espírito Santo State (Without Holidays)
            ['2017-01-01', null, null, ['region' => 'NATIONAL', 'name' => 'Confraternização Universal']],
            // Goiás State (Without Holidays)
            ['2017-01-01', null, null, ['region' => 'NATIONAL', 'name' => 'Confraternização Universal']],
            // Maranhão State
            ['2017-07-28', static::STATE_MA, null, ['region' => 'STATE', 'name' => 'Adesão do Maranhão à Independência do Brasil']],
            // Mato Grosso State
            ['2017-11-20', static::STATE_MT, null, ['region' => 'STATE', 'name' => 'Dia da Consciência Negra']],
            // Mato Grosso do Sul State
            ['2017-10-11', static::STATE_MS, null, ['region' => 'STATE', 'name' => 'Criação do Estado']],
            // Minas Gerais State
            ['2017-04-21', static::STATE_MG, null, ['region' => 'STATE', 'name' => 'Data Magna do Estado']],
            // Pará State
            ['2017-08-15', static::STATE_PA, null, ['region' => 'STATE', 'name' => 'Adesão do Grão-Pará à Independência do Brasil']],
            // Paraíba State
            ['2017-07-26', static::STATE_PB, null, ['region' => 'STATE', 'name' => 'Homenagem à Memória do Ex-Presidente João Pessoa']],
            ['2017-08-05', static::STATE_PB, null, ['region' => 'STATE', 'name' => 'Fundação do Estado']],
            // Paraná State
            ['2017-12-19', static::STATE_PR, null, ['region' => 'STATE', 'name' => 'Emancipação Política']],
            // Pernambuco State (Variable)
            ['2016-03-06', static::STATE_PE, null, ['region' => 'STATE', 'name' => 'Revolução Pernambucana']],
            ['2017-03-06', static::STATE_PE, null, ['region' => 'STATE', 'name' => 'Revolução Pernambucana']],
            ['2018-03-06', static::STATE_PE, null, ['region' => 'STATE', 'name' => 'Revolução Pernambucana']],
            // Piauí State
            ['2017-10-19', static::STATE_PI, null, ['region' => 'STATE', 'name' => 'Dia do Piauí']],
            // Rio de Janeiro State
            ['2017-04-23', static::STATE_RJ, null, ['region' => 'STATE', 'name' => 'São Jorge']],
            ['2017-11-20', static::STATE_RJ, null, ['region' => 'STATE', 'name' => 'Dia da Consciência Negra']],
            // Rio Grande do Norte State
            ['2017-10-03', static::STATE_RN, null, ['region' => 'STATE', 'name' => 'Mártires de Cunhaú e Uruaçu']],
            // Rio Grande do Sul State
            ['2017-09-20', static::STATE_RS, null, ['region' => 'STATE', 'name' => 'Proclamação da República Rio-Grandense']],
            // Rondônia State
            ['2017-01-04', static::STATE_RO, null, ['region' => 'STATE', 'name' => 'Criação do Estado']],
            ['2017-06-18', static::STATE_RO, null, ['region' => 'STATE', 'name' => 'Dia do Evangélico']],
            // Roraima State
            ['2017-10-05', static::STATE_RR, null, ['region' => 'STATE', 'name' => 'Criação do Estado']],
            // Santa Catarina State
            ['2017-07-09', static::STATE_SC, null, ['region' => 'STATE', 'name' => 'Revolução Constitucionalista']],
            ['2017-11-25', static::STATE_SC, null, ['region' => 'STATE', 'name' => 'Santa Catarina de Alexandria']],
            // São Paulo State
            ['2017-07-09', static::STATE_SP, null, ['region' => 'STATE', 'name' => 'Revolução Constitucionalista']],
            // Sergipe State
            ['2017-07-08', static::STATE_SE, null, ['region' => 'STATE', 'name' => 'Emancipação Política']],
            // Tocantins State
            ['2017-03-18', static::STATE_TO, null, ['region' => 'STATE', 'name' => 'Autonomia do Estado']],
            ['2017-09-08', static::STATE_TO, null, ['region' => 'STATE', 'name' => 'Padroeira do Estado']],
            ['2017-10-05', static::STATE_TO, null, ['region' => 'STATE', 'name' => 'Criação do Estado']],
        ];
    }
}
