<?php
mail(
    'example@example.jp',
    'test mail subject',
    '--__BOUNDARYBOUNDARYBOUNDARY__
Content-Type: text/plain

testtest
testtest
testtest
--__BOUNDARYBOUNDARYBOUNDARY__
Content-Type: application/octet-stream; name="fax.pdf"
Content-Disposition: attachment; filename="fax.pdf"
Content-Transfer-Encoding: base64

' . chunk_split(base64_encode(file_get_contents('fax.pdf'))) . '
--__BOUNDARYBOUNDARYBOUNDARY__--',
    'Content-Type: multipart/mixed;boundary="__BOUNDARYBOUNDARYBOUNDARY__"'
);