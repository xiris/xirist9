<?php
/**
 * CHRISTOPHER SILVA

 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @copyright     Copyright (c) 2014 Christopher Silva. (http://www.xiris.com.br/)
 * @author        Christopher Silva <xiris@xiris.com.br>
 */

/**
 * Class xT9
 */
class XirisT9
{
    /**
     * @var string
     */
    const DICT_PATH   = '/usr/share/dict/american-english';
    const ALPHABET    = 'ABCDEFGHIJKLMNOPQRSTUVXZ';
    const ALPHABET_T9 = '22233344455566677778889999';

    /**
     * @var array
     * @access private
     */
    private $dictionary   = array();

    /**
     * @var array
     * @access private
     */
    private $dictionaryT9 = array();

    /**
     * @param string $dictionaryPath
     */
    public function setDictionary($dictionaryPath = self::DICT_PATH)
    {
        $this->dictionary = file($dictionaryPath);
        $this->setDictionaryT9($this->dictionary);
    }

    /**
     * @param array $dictionary
     * @access private
     */
    private function setDictionaryT9(array $dictionary)
    {
        foreach ($dictionary as $item) {
            $item = trim($item);
            $t9   = $this->getT9Word($item);

            $this->dictionaryT9[$t9][] = $item;
        }
    }

    /**
     * @param $word
     * @return string
     * @access private
     */
    private function getT9Word($word)
    {
        $word = strtoupper($word);
        return strtr($word, self::ALPHABET, self::ALPHABET_T9);
    }
}
// --------------- end class ----------------//



$t9 = new XirisT9();
$t9->setDictionary();

echo "\n\nHello baby, type something and then press [enter] ...\n\n";

$stdin = fopen('php://stdin', 'r');
while (!feof($stdin)) {
    echo fgets($stdin);
}
fclose($stdin);