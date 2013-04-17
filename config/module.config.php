<?php
return array(
    'view_helpers' => array(
        'invokables' => array(
            'csvOutput' => 'CaoCsvOutput\View\Helper\CaoCsvOutput',
        ),
    ),
    'view_manager' => array(
        'strategies' => array(
            'ViewCsvStrategy'
        )
    ),
    'service_manager' => array(
        'factories' => array(
            'ViewCsvStrategy' => 'CaoCsvOutput\Mvc\Service\ViewPdfStrategyFactory',
        )
    )
);
