<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/documentoFormato/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <?php
            if($documentoFormato && is_object($documentoFormato)){
                echo "
                    <div class='record-one'>
                        <span>ID: $documentoFormato->idDocumentoFormato</span>
                        <span>Código: $documentoFormato->codigo</span>
                        <span>Nombre: $documentoFormato->nombre</span>
                        <span>Tipo: $documentoFormato->tipo</span>
                        <span>Tipo Documento Formato: $documentoFormato->tipo_doc_formato</span>
                        <span>Proceso ID: $documentoFormato->fkProceso</span>
                        <span>Tipo Documental ID: $documentoFormato->fkTipoDocumental</span>
                    </div>
                ";
            }
        ?>
    </div>
</div>