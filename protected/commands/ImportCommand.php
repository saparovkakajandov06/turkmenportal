<?php

class ImportCommand extends CConsoleCommand {
    const BORDER_WIDTH = 80;

    public function actionIndex($args) {
        $message = $this->alignText('This text is aligned to the right border...', 'right') . "\n";
        $message .= "\n";
        $message .= $this->alignText('...this one is centered...', 'center') . "\n";
        $message .= "\n";
        $message .= $this->alignText('...and this is left as is, so aligned to the left border!', 'left') . "\n";
        $message .= "\n\n";
        $message .= $this->alignText('Finally we have a really long text, no matter, how aligned, that is going to be cut right there, where it should');

        $this->drawBorder($message);

        $this->readStdin();

        echo 'You selected: ' . $this->readStdin('Enter any alphabet letter, please...');

        $this->clearStdin();
    }

    /**
     * Aligns text to given margin.
     *
     * @param  string $text Text to be aligned.
     * @param  string $align Align method: 'right', 'center' or 'left' (default == empty string).
     * @param  integer $lineWidth Maximim line width. If not specified, class' constant will be used instead.
     *
     * @return string             Aligned text, pad with trailing and following spaces.
     */
    public function alignText($text, $align = 'left', $lineWidth = null) {
        $lineWidth = is_null($lineWidth) ? self::BORDER_WIDTH : $lineWidth;
        $lineWidth = $lineWidth - 4;

        $text = strlen($text) > $lineWidth ? substr($text, 0, $lineWidth) : $text;

        if ($align === 'right') {
            return str_repeat(' ', $lineWidth - strlen($text)) . $text;
        }

        if ($align === 'center') {
            $margin = floor($lineWidth / 2) - floor(strlen($text) / 2);

            return str_repeat(' ', $margin) . str_pad($text, $margin, ' ');
        } else return $text;
    }

    /**
     * Draws console-like (DOS-like?) text border around passed text.
     *
     * @param  string $text Text to be outlined in a fancy-like text border.
     * @param  integer $lineWidth Maximim width of each border line. See above for details.
     */
    public function drawBorder($text, $lineWidth = null) {
        $lineWidth = is_null($lineWidth) ? self::BORDER_WIDTH : $lineWidth;
        $lineWidth = $lineWidth > 80 ? 80 : $lineWidth;

        $nl = $lineWidth === 80 ? '' : "\n";

        echo str_repeat('*', $lineWidth) . $nl;

        echo '*' . str_repeat(' ', $lineWidth - 2) . '*' . $nl;

        foreach (explode("\n", $text) as $line) echo '* ' . str_pad($line, $lineWidth - 4, ' ') . ' *' . $nl;

        echo '*' . str_repeat(' ', $lineWidth - 2) . '*' . $nl;

        echo str_repeat('*', $lineWidth) . $nl;
    }

    /**
     * Get user entry / decision.
     *
     * @param  string $message Information to be displayed, when requiring user to enter something.
     *
     * @return string          User entry.
     */
    public function readStdin($message = 'Continue [Y/N]?') {
        echo $message;

        $handle = fopen("php://stdin", "r");
        $line = fgets($handle);

        return trim($line);
    }

    /**
     * Clears console window.
     *
     * The implementation used here can't be anymore ugly, but it is the only one,
     * that is working, when using GitBash. All other methods fails:
     *
     * http://stackoverflow.com/a/24327758/1469208
     * http://stackoverflow.com/a/29193143/1469208
     */
    public function clearStdin() {
        for ($i = 0; $i < 50; $i++) echo "rn";
    }
}