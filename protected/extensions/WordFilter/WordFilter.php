<?php
/**
 * @author Cozumel
 * @link http://phpwolfcamp.com
 * @date 23/07/13
 * @time 3.36 AM
 * @link http://www.yiiframework.com/extension/word-filter/
 *
 * @credit
 * http://stackoverflow.com/a/17535967/1812355
 * http://www.yiiframework.com/extension/bad-words-filter/
 */
class WordFilter extends CApplicationComponent
{

    public function replacement($value)
    {




//
//        $replacements = array(
//            'voldemort'   => 'he who must not be named',
//            'fuck' => 'fu@k',
//            'shit'   => 'teddy bears'
//        );
//
//        // Dynamically form the regex, properly escaping it
//        $delimiter = '/';
//        $words = array_keys( $replacements);
//        $regex = $delimiter . '\b(' . implode('|', array_map( 'preg_quote', $words, array_fill( 0, count( $words), $delimiter))) . ')\b' . $delimiter;
//
//        $result = preg_replace_callback( $regex, function( $match) use( $replacements) {
//            return $replacements[$match[1]];
//        }, $value);
//
//        return $result;


    }

    public function sterling($value)
    {

        if (!is_file(Yii::getPathOfAlias('application.runtime.WordFilter') . '/sterling.json') || (time() - filemtime(Yii::getPathOfAlias('application.runtime.WordFilter') .'/sterling.json')) > 3600*24*7) {
            WordList::filterWords();
        } else {
            $data = file_get_contents(Yii::getPathOfAlias('application.runtime.WordFilter') . '/sterling.json');
        }

        $data = json_decode($data, true);


        $value = explode(' ', $value);

        foreach ($data as $datum) {
            if (in_array(ucfirst(trim($datum)), $value)) return false;
            if (in_array(lcfirst(trim($datum)), $value)) return false;

        }

        return true;

    }

}
?>