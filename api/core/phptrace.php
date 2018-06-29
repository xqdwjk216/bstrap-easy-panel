<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class PhpTrace {

    /**
     *
     * @var $trace_file string 单条trace的文件名(绝对路径) 
     * @var $trace_file_line int 单条trace的文件行号
     * @var $next_trace object 下条trace信息
     * @var $prev_trace object 上一条trace信息
     */
    var $trace_file = "";
    var $trace_file_line = 0;
    var $next_trace = NULL;
    var $prev_trace = NULL;

    public function __construct($trace_file_name, $trace_file_number) {
        $this->trace_file = $trace_file_name;
        $this->trace_file_line = $trace_file_number;
    }

    public function setNextTrace($trace) {
        $this->next_trace = $trace;
    }

    public function setPrevTrace($trace) {
        $this->prev_trace = $trace;
    }

    /**
     * 文件路径
     * @return string
     */
    public function getTraceFile() {
        return $this->trace_file;
    }

    /**
     * 行号
     * @return int
     */
    public function getTraceFileLine() {
        return $this->trace_file_line;
    }

    /**
     * 下一条trace信息
     * @return object
     */
    public function getNextTrace() {
        return $this->next_trace;
    }

    /**
     * 获取调用栈信息
     * @return array
     */
    public static function getBackTrace() {
        return debug_backtrace();
    }

    /**
     * 正则查找最近的调用栈,匹配的是文件名或路径
     */
    public static function traceFindTop($pattern) {
        $trace_arr = self::getBackTrace();
        foreach ($trace_arr as $trace) {
            if (preg_match($pattern, $trace['file'])) {
                $traceObj = new PhpTrace($trace['file'], $trace['line']);
                return $traceObj;
            }
        }
    }

    /**
     * 查找匹配的调用栈返回多个,匹配的是文件名或路径
     */
    public static function traceFindMulti($pattern) {
        $trace_arr = self::getBackTrace();
        $match_trace_arr = [];
        foreach ($trace_arr as $trace) {
            if (preg_match($pattern, $trace['file'])) {
                $traceObj = new PhpTrace($trace['file'], $trace['line']);
                if (isset($prevTraceObj)) {
                    $prevTraceObj->setNextTrace($traceObj);
                    $traceObj->setPrevTrace($prevTraceObj);
                }
                $prevTraceObj = $traceObj;
                $match_trace_arr[] = $traceObj;
            }
        }
        return $match_trace_arr;
    }

    /**
     * 根据层级获取trace信息,如-1获取上一层,-2获取上上一层
     * @param type $indent
     * @return type
     * @throws Exception
     */
    //db -> log.error -> log.flush -> phptrace
    public static function getTraceByIndent($indent, $currentFile = NULL, $currentLine = NULL) {
        $trace_arr = self::getBackTrace();
        $len = count($trace_arr);
        if (abs($indent - 1) > $len) {
            throw new Exception("indent offset wrong");
        }

        $currentIdx = 0;
        $idx = 0;
        if (!is_null($currentFile)) {
            foreach ($trace_arr as $trace) {
                if ($trace['file'] == $currentFile && $trace['line'] == $currentLine) {
                    $currentIdx = $idx;
                    break;
                }
                $idx++;
            }
        }

        $abs_idx = $idx - $indent;
        $trace = $trace_arr[$abs_idx];
        $traceObj = new PhpTrace($trace['file'], $trace['line']);
        if (isset($trace_arr[$abs_idx + 1])) {
            $prevTraceObj = new PhpTrace($trace_arr[$abs_idx + 1]['file'], $trace_arr[$abs_idx + 1]['line']);
            $traceObj->setPrevTrace($prevTraceObj);
        }
        if (isset($trace_arr[$abs_idx - 1])) {
            $nextTraceObj = new PhpTrace($trace_arr[$abs_idx - 1]['file'], $trace_arr[$abs_idx - 1]['line']);
            $traceObj->setNextTrace($nextTraceObj);
        }
        return $traceObj;
    }

    public static function getTraceTop() {
        $trace_arr = self::getBackTrace();
        $len = count($trace_arr);
        return self::getTraceByIndent(-1 * $len);
    }

}
