<?php
/*
  Copyright (c) 2018, Monero Integrations

  Permission is hereby granted, free of charge, to any person obtaining a copy
  of this software and associated documentation files (the "Software"), to deal
  in the Software without restriction, including without limitation the rights
  to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
  copies of the Software, and to permit persons to whom the Software is
  furnished to do so, subject to the following conditions:

  The above copyright notice and this permission notice shall be included in all
  copies or substantial portions of the Software.

  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
  IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
  FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
  AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
  LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
  OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
  SOFTWARE.
*/

namespace App\Marketplace\Utility\MoneroRPC;

    class Serialize
    {
        protected $varint;

        public function __construct()
        {
            $this->varint = new Varint();
        }

        public function deserialize_block_header($block)
        {
          $data = str_split($block, 2);

          $major_version = $this->varint->decode_varint($data);
          $data = $this->varint->pop_varint($data);

          $minor_version = $this->varint->decode_varint($data);
          $data = $this->varint->pop_varint($data);

          $timestamp = $this->varint->decode_varint($data);
          $data = $this->varint->pop_varint($data);

          $nonce = $this->varint->decode_varint($data);
          $data = $this->varint->pop_varint($data);

          return array("major_version" => $major_version,
                       "minor_version" => $minor_version,
                       "timestamp" => $timestamp,
                       "nonce" => $nonce);
        }

    }
