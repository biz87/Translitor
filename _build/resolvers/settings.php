<?php
/** @var xPDOTransport $transport */
/** @var array $options */
/** @var modX $modx */
if ($transport->xpdo) {
    $modx =& $transport->xpdo;

    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
        case xPDOTransport::ACTION_UPGRADE:
            $settins =  [
                'friendly_alias_translit_class_path' => [
                    'key' => 'friendly_alias_translit_class_path',
                    'xtype' => 'textfield',
                    'value' => '{core_path}components/translitor/model/',
                    'namespace' => 'core',
                    'area' => 'furls',
                ],
                'friendly_alias_translit_class' => array(
                    'key' => 'friendly_alias_translit_class',
                    'xtype' => 'textfield',
                    'value' => 'translitor',
                    'namespace' => 'core',
                    'area' => 'furls',
                ),
                'friendly_alias_translit' => array(
                    'key' => 'friendly_alias_translit',
                    'xtype' => 'textfield',
                    'value' => 'russian',
                    'namespace' => 'core',
                    'area' => 'furls',
                ),
            ];

            foreach($settins as $item){
                $setting = $modx->getObject('modSystemSetting', array('key' => $item['key']));
                if($setting){
                    $setting->set('value', $item['value']);
                    $setting->save();
                    $modx->log(modX::LOG_LEVEL_INFO, "Меняю системную настройку {$item['key']} - устанавливаю значение {$item['value']}");
                }
            }

            break;

        case xPDOTransport::ACTION_UNINSTALL:
            break;
    }
}

return true;