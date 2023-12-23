<img src="data:image/png;base64,<?php ob_start(); imagepng($image); echo base64_encode(ob_get_clean()); ?>" alt="Generated Image">
<input type="hidden" name="protector_hash" value="{{ $hash }}">
