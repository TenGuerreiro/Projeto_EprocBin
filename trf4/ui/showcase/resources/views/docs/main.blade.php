@extends($template)


@section('content')
    <div class="container-fluid" id="wrapper">
        <div class="row">

            <div id="sidebar-wrapper">
                @include("docs.sidebar.main")
            </div>

            <div id="page-content-wrapper" class="col container-fluid">
                <div>
                    <div class="card">
                        <div class="card-header">
                            <h2>Conceitos</h2>
                        </div>

                        <div class="card-body">

                            <h3>Componente</h3>
                            <p>É um conjunto de elementos que deve prover uma interação padronizada aos usuários,
                                possivelmente configurável.
                                Ex.:</p>
                            <ul>
                                <li>Área de upload de arquivos (fileUploader)</li>
                                <li>Select</li>
                                <li>Campo de texto (inputText)</li>
                            </ul>

                            <hr/>

                            <h4>Subcomponentes</h4>
                            <p>São as peças que compõem um componente. Um select, por exemplo, é composto por:</p>
                            <ul>
                                <li><code>label</code> (rótulo do select)</li>
                                <li><code>select</code> (o campo principal)</li>
                                <li><code>wrapper</code> (o elemento que agrupa o label e o select)</li>
                            </ul>

                            <hr/>

                            <h4>Subcomponente principal</h4>
                            <p>É o subcomponente configurado por padrão quando executado um método qualquer de um
                                componente.</p>
                            <p>Ex:
                                Ao chamar o método <code>class('abc')</code> no componente <code>select</code>, será
                                aplicada a classe 'abc' ao elemento <code>&lt;select&gt;</code>.</p>

                            <hr/>

                            <h4>Renderer</h4>
                            <p>Os componentes são abstratos - são apenas conceitos.</p>
                            <p>O renderer é a classe responsável por concretizar isso, ou seja, construir um
                                componente
                                usando o estilo por ela determinado.
                                Hoje existem dois renderers:</p>
                            <ul>
                                <li>Infra</li>
                                <li>Bootstrap4</li>
                            </ul>
                        </div>
                    </div>

                    <br>
                    <br>

                    <div class="card">
                        <div class="card-header">
                            <h3>Utilização</h3>
                        </div>
                        <div class="card-body">
                            <p>Os componentes estão elencados na classe <code>UI</code>.</p>
                            <h4>Personalizações específicas</h4>
                            <p>Cada componente possui suas próprias personalizações. Para isso, veja a documentação
                                de
                                cada
                                classe de componente.</p>
                            <p>Exemplos:</p>
                            <ul>
                                <li>button possui o método <code>primary()</code>;</li>
                                <li>campos de formulário possuem o método <code>required()</code>
                                </li>
                            </ul>

                            <hr/>

                            <h4>Configurando elemento principal</h4>
                            <p>Para definir qualquer atributo dos elementos de um componente, pode-se invocar
                                métodos
                                inexistentes (mágicos).
                                A conversão funciona da seguinte forma:</p>
                            <ul>
                                <li>nome do método = nome do atributo</li>
                                <li>valor do método = valor do atributo</li>
                                <li>Métodos em <code>camelCase</code> são convertidos para <code>kebab-case</code>
                                </li>
                            </ul>
                            <p>Exemplos:</p>
                            <table>
                                <thead>
                                <tr>
                                    <th>método</th>
                                    <th>resultado HTML</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><code>-&gt;class('no-padding')</code></td>
                                    <td>class="no-padding"</td>
                                </tr>
                                <tr>
                                    <td><code>-&gt;dataTestUrl('abc')</code></td>
                                    <td>data-test-url="abc"</td>
                                </tr>
                                </tbody>
                            </table>

                            <hr/>

                            <h4>Configurando outros subcomponentes</h4>
                            <p>Para definir atributos de outros subcomponentes como <code>label</code> e
                                <code>wrapper</code>, pode ser usada uma sintaxe especial por meio da qual, <strong>chamando
                                    um método com o mesmo nome do subcomponente</strong>:</p>
                            <ul>
                                <li>o <strong>primeiro</strong> parâmetro é o <strong>nome</strong> do atributo</li>
                                <li>o <strong>segundo</strong> parâmetro é o <strong>valor</strong> desse atributo
                                </li>
                            </ul>
                            <p>Por exemplo:</p>
                            <pre class="language-php line-numbers"><code class="language-php">UI::button(...)
  ->primary()
  ->_wrapper('style', 'color:"red"')

  // Se "wrapper" fosse o subcomponente principal, seria o equivalente a chamar `$wrapper->style('color:"red"')</code></pre>
                        </div>
                    </div>
                </div>

                <hr/>

                @include('docs.content.main')

                <div class="pt-2 text-center">
                    <code>
                        <small> Documentação gerada a partir de casos de teste, afinal #cleancodematters :)
                            <br> Mais informações <a
                                href="https://git.trf4.jus.br/infra_php/infra_php_fontes/blob/desenv/infra_php/ui/README.md#showcase">no
                                README</a>
                        </small>
                    </code>
                </div>
            </div>
        </div>
    </div>
@endsection