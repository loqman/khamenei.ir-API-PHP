<?php
/** ================================================================================
 * The MIT License (MIT)
 *
 * Copyright (c) 2013 loqman
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of
 *  this software and associated documentation files (the "Software"), to deal in
 *  the Software without restriction, including without limitation the rights to
 *  use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of
 *  the Software, and to permit persons to whom the Software is furnished to do so,
 *  subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 *  IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS
 *  FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
 *  COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER
 *  IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN
 *  CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 ================================================================================ */

/**
 * Class KhameneiAPI
 *
 * the functions provided in this class are based on description of khamenei.ir api
 * described in http://farsi.khamenei.ir/help-content?id=21881 as of 24/11/2013
 */
class KhameneiAPI {

    /* Constants Definition */
    // Orders
    const DATE_ASC = 'date_asc';
    const DATE_DESC = 'date_desc';
    const ID_ASC = 'id_asc';
    const ID_DESC = 'id_desc';

    // News types
    const TYPE_NEWS = 1;
    const TYPE_SPEECH = 2;
    const TYPE_ROADMAP = 3;
    const TYPE_MESSAGE = 4;
    const TYPE_LETTER = 4;
    const TYPE_MEETING_MARGIN = 5;
    const TYPE_PHOTO = 6;
    const TYPE_VIDEO = 7;
    const TYPE_AUDIO = 8;
    const TYPE_SPEECH_SELECTION = 9;
    const TYPE_FILE = 11;
    const TYPE_OTHERS_NOTE = 12;
    const TYPE_OTHERS_DISCUSSION = 13;
    const TYPE_OTHERS_MEMORY = 14;
    const TYPE_OTHERS_REPORT = 22;
    const TYPE_OTHERS_PHOTO = 44;
    const TYPE_MEMORY = 16;
    const TYPE_TELEX_TEXT = 17;
    const TYPE_TELEX_PHOTO = 18;
    const TYPE_TELEX_AUDIO = 19;
    const TYPE_TELEX_VIDEO = 20;
    const TYPE_TELEX_BLOG = 30;
    const TYPE_ARTICLE = 26;
    const TYPE_SPECIAL_PHOTO = 28;
    const TYPE_POSTER = 29;
    const TYPE_NOTICE = 32;
    const TYPE_PACKAGE = 33;
    const TYPE_HADITH_EXPLANATION = 34;
    const TYPE_BOOK = 38;
    const TYPE_SMS = 39;
    const TYPE_IMAM_KHOMEINI_SAHIFE = 40;
    const TYPE_POEM = 43;
    const TYPE_FAVORITE = 45;
    const TYPE_REFERENCE = 46;
    const TYPE_ALLUSION = 46;
    const TYPE_MANUSCRIPT = 47;
    const TYPE_ESTEFTAAT = 48;
    const TYPE_QUICK_REVIEW = 49;
    const TYPE_DIARY = 50;

    // uri: http://farsi.khamenei.ir/developer/api/news?news_type={$type}&limit={$number}
    const BASE_URI = "http://farsi.khamenei.ir/developer/api/news?";
    /* ==================== */

    /* API Parameters       */
    private $version = 1;
    private $news_type = 1;
    private $limit = 20;
    private $offset = 1;
    private $news_id = 1;
    private $from_year = 1368; // minimum is the default value
    private $to_year = 1392; // maximum is current year
    private $response_format = "rss"; // only this format is available at the time
    private $return_body = true;
    private $return_lead = false;
    private $order = 0;

    private $api_uri;
    /* ===================== */

    public function __construct()
    {

    }

    public function type($type)
    {
        $this->news_type = $type;
        return $this;
    }

    public function version($version)
    {
        $this->version = $version;
        return $this;
    }

    public function limit($limit)
    {
        $this->limit = $limit;
        return $this;
    }

    public function offset($offset)
    {
        $this->offset = $offset;
        return $this;
    }

    public function news_id($id)
    {
        $this->news_id = $id;
        return $this;
    }

    public function from_year($year)
    {
        $this->from_year = $year;
        return $this;
    }

    public function to_year($year)
    {
        $this->to_year = $year;
        return $this;
    }

    public function response_format($format)
    {
        $this->response_format = $format;
        return $this;
    }

    public function return_body()
    {
        $this->return_body = true;
        $this->return_lead = false;
        return $this;
    }

    public function return_lead()
    {
        $this->return_body = false;
        $this->return_lead = true;
        return $this;
    }

    public function order_by($order)
    {
        $this->order = $order;
        return $this;
    }

    public function get()
    {
        $this->api_uri = $this->construct_uri();
        $response = file_get_contents($this->api_uri);
        echo "<pre>";
        echo $response;
        echo "</pre>";
    }

    // Private methods
    private function construct_uri()
    {
        $uri = $this::BASE_URI . "ver={$this->version}";
        if ($this->news_type != null)
            $uri .= "&news_type={$this->news_type}";
        if ($this->limit != null)
            $uri .= "&limit={$this->limit}";
        if ($this->offset != null)
            $uri .= "&offset={$this->offset}";
        if ($this->news_id != null)
            $uri .= "&news_id{$this->news_id}";
        if ($this->from_year != null)
            $uri .= "&{from_year=$this->from_year}";
        if ($this->to_year != null)
            $uri .= "&{to_year=$this->to_year}";
        if ($this->response_format != null)
            $uri .= "&{response_format=$this->response_format}";
        if ($this->return_body)
            $uri .= "&return_body=true";
        if ($this->return_lead)
            $uri .= "&return_lead=true";
        if ($this->order != null)
            $uri .= "&order={$this->order}";
        return $uri;
    }
}