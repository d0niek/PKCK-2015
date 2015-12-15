<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet
    version="2.0"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:ext="http://exslt.org/common" xmlns:xsL="http://www.w3.org/1999/XSL/Transform"
    exclude-result-prefixes="ext">

    <xsl:output method="text" encoding="utf-8" indent="yes" />

    <xsl:variable name="endl" select="'&#xA;'"/>

    <xsl:variable name="vLine" select="'║'" />
    <xsl:variable name="hLine" select="'═'" />
    <xsl:variable name="ltCorner" select="'╔'" />
    <xsl:variable name="lbCorner" select="'╚'" />
    <xsl:variable name="rtCorner" select="'╗'" />
    <xsl:variable name="rbCorner" select="'╝'" />
    <xsl:variable name="lhLine" select="'─'" />
    <xsl:variable name="width" select="100" />

    <xsl:template match="/">
        <xsl:call-template name="topFrame">
            <xsl:with-param name="length" select="$width" />
            <xsl:with-param name="title" select="' Title '" />
        </xsl:call-template>
        <xsl:call-template name="bottomFrame">
            <xsl:with-param name="length" select="$width" />
        </xsl:call-template>
    </xsl:template>

    <xsl:template name="topFrame">
        <xsl:param name="length" />
        <xsl:param name="title" />

        <xsl:value-of select="$ltCorner" />
        <xsl:value-of select="$hLine" />

        <xsl:if test="$title != ''">
            <xsl:value-of select="$title" />
        </xsl:if>

        <xsl:call-template name="line">
            <xsl:with-param name="char" select="$hLine" />
            <xsl:with-param name="length" select="$length - 1 -string-length($title)" />
        </xsl:call-template>

        <xsl:value-of select="$rtCorner" />
        <xsl:value-of select="$endl" />
    </xsl:template>

    <xsl:template name="bottomFrame">
        <xsl:param name="length" />

        <xsl:value-of select="$lbCorner" />

        <xsl:call-template name="line">
            <xsl:with-param name="char" select="$hLine" />
            <xsl:with-param name="length" select="$length" />
        </xsl:call-template>

        <xsl:value-of select="$rbCorner" />
        <xsl:value-of select="$endl" />
    </xsl:template>

    <xsl:template name="line">
        <xsl:param name="char" />
        <xsl:param name="length" />

        <xsl:call-template name="repeat">
            <xsl:with-param name="char" select="$char" />
            <xsl:with-param name="length" select="$length" />
        </xsl:call-template>
    </xsl:template>

    <xsl:template name="repeat">
        <xsl:param name="char" />
        <xsl:param name="length" />

        <xsl:if test="$length &gt; 0">
            <xsl:value-of select="$char" />
            <xsl:call-template name="repeat">
                <xsl:with-param name="char" select="$char" />
                <xsl:with-param name="length" select="$length - 1" />
            </xsl:call-template>
        </xsl:if>
    </xsl:template>

</xsl:stylesheet>