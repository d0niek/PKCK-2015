<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet
    version="2.0"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:ext="http://exslt.org/common"
    exclude-result-prefixes="ext">

    <xsl:output method="text" encoding="utf-8" indent="no" />

    <xsl:strip-space elements="*"/>

    <xsl:variable name="endl" select="'&#xA;'"/>

    <xsl:variable name="vLine" select="'║'" />
    <xsl:variable name="hLine" select="'═'" />
    <xsl:variable name="ltCorner" select="'╔'" />
    <xsl:variable name="lbCorner" select="'╚'" />
    <xsl:variable name="rtCorner" select="'╗'" />
    <xsl:variable name="rbCorner" select="'╝'" />
    <xsl:variable name="lhLine" select="'─'" />
    <xsl:variable name="width" select="50" />

    <xsl:template match="/">
        <xsl:apply-templates />
    </xsl:template>

    <xsl:template match="/kolekcja">
        <xsl:apply-templates />
    </xsl:template>

    <xsl:template match="/kolekcja/nagłówek">
        <xsl:call-template name="topFrame">
            <xsl:with-param name="length" select="$width" />
            <xsl:with-param name="title" select="concat(' ', opis, ', ', data, ' ')" />
            <xsl:with-param name="nesting" select="0" />
        </xsl:call-template>

        <xsl:call-template name="textInFrame">
            <xsl:with-param name="text" select="' '" />
            <xsl:with-param name="length" select="$width" />
            <xsl:with-param name="nesting" select="0" />
        </xsl:call-template>
    </xsl:template>

    <xsl:template match="/kolekcja/wykonawcy">
        <xsl:call-template name="textInFrame">
            <xsl:with-param name="text" select="' Wykonawcy:'" />
            <xsl:with-param name="length" select="$width" />
            <xsl:with-param name="nesting" select="0" />
        </xsl:call-template>

        <xsl:apply-templates />
    </xsl:template>

    <xsl:template match="/kolekcja/wykonawcy/wykonawca">
        <xsl:call-template name="topFrame">
            <xsl:with-param name="length" select="$width" />
            <xsl:with-param name="title" select="concat(' ', nazwa, ' ')" />
            <xsl:with-param name="nesting" select="1" />
        </xsl:call-template>

        <xsl:call-template name="textInFrame">
            <xsl:with-param name="text" select="concat('Gatunek: ', gatunek)" />
            <xsl:with-param name="length" select="$width" />
            <xsl:with-param name="nesting" select="1" />
        </xsl:call-template>

        <xsl:call-template name="textInFrame">
            <xsl:with-param name="text" select="concat('Ilośc płyt: ', ilość_płyt)" />
            <xsl:with-param name="length" select="$width" />
            <xsl:with-param name="nesting" select="1" />
        </xsl:call-template>

        <xsl:call-template name="textInFrame">
            <xsl:with-param name="text" select="'Płyty: '" />
            <xsl:with-param name="length" select="$width" />
            <xsl:with-param name="nesting" select="1" />
        </xsl:call-template>

        <xsl:apply-templates select="płyty/płyta" />

        <xsl:call-template name="bottomFrame">
            <xsl:with-param name="length" select="$width" />
            <xsl:with-param name="nesting" select="1" />
        </xsl:call-template>
    </xsl:template>

    <xsl:template match="/kolekcja/wykonawcy/wykonawca/płyty/płyta">
        <xsl:call-template name="topFrame">
            <xsl:with-param name="length" select="$width" />
            <xsl:with-param name="title" select="concat(' ', tytuł, ' ')" />
            <xsl:with-param name="nesting" select="2" />
        </xsl:call-template>

        <xsl:call-template name="textInFrame">
            <xsl:with-param name="text" select="concat('Ranking: ', ranking)" />
            <xsl:with-param name="length" select="$width" />
            <xsl:with-param name="nesting" select="2" />
        </xsl:call-template>

        <xsl:call-template name="textInFrame">
            <xsl:with-param name="text" select="concat('Liczba utworów: ', liczba_utworów)" />
            <xsl:with-param name="length" select="$width" />
            <xsl:with-param name="nesting" select="2" />
        </xsl:call-template>

        <xsl:call-template name="textInFrame">
            <xsl:with-param name="text" select="concat('Czas trwania: ', czas_trwania)" />
            <xsl:with-param name="length" select="$width" />
            <xsl:with-param name="nesting" select="2" />
        </xsl:call-template>

        <xsl:call-template name="textInFrame">
            <xsl:with-param name="text" select="concat('Cena: ', cena/brutto, ' (VAT ', cena/VAT, ')')" />
            <xsl:with-param name="length" select="$width" />
            <xsl:with-param name="nesting" select="2" />
        </xsl:call-template>

        <xsl:call-template name="bottomFrame">
            <xsl:with-param name="length" select="$width" />
            <xsl:with-param name="nesting" select="2" />
        </xsl:call-template>
    </xsl:template>

    <xsl:template match="/kolekcja/podsumowanie">
        <xsl:call-template name="bottomFrame">
            <xsl:with-param name="length" select="$width" />
            <xsl:with-param name="nesting" select="0" />
        </xsl:call-template>
    </xsl:template>

    <xsl:template name="topFrame">
        <xsl:param name="length" />
        <xsl:param name="title" />
        <xsl:param name="nesting" />

        <xsl:call-template name="repeat">
            <xsl:with-param name="char" select="$vLine" />
            <xsl:with-param name="length" select="$nesting" />
        </xsl:call-template>

        <xsl:value-of select="$ltCorner" />
        <xsl:value-of select="$hLine" />

        <xsl:if test="$title != ''">
            <xsl:value-of select="$title" />
        </xsl:if>

        <xsl:call-template name="line">
            <xsl:with-param name="char" select="$hLine" />
            <xsl:with-param name="length" select="$length - 1 -string-length($title) - (2 * $nesting)" />
        </xsl:call-template>

        <xsl:value-of select="$rtCorner" />

        <xsl:call-template name="repeat">
            <xsl:with-param name="char" select="$vLine" />
            <xsl:with-param name="length" select="$nesting" />
        </xsl:call-template>

        <xsl:value-of select="$endl" />
    </xsl:template>

    <xsl:template name="bottomFrame">
        <xsl:param name="length" />
        <xsl:param name="nesting" />

        <xsl:call-template name="repeat">
            <xsl:with-param name="char" select="$vLine" />
            <xsl:with-param name="length" select="$nesting" />
        </xsl:call-template>

        <xsl:value-of select="$lbCorner" />

        <xsl:call-template name="line">
            <xsl:with-param name="char" select="$hLine" />
            <xsl:with-param name="length" select="$length - (2 * $nesting)" />
        </xsl:call-template>

        <xsl:value-of select="$rbCorner" />

        <xsl:call-template name="repeat">
            <xsl:with-param name="char" select="$vLine" />
            <xsl:with-param name="length" select="$nesting" />
        </xsl:call-template>

        <xsl:value-of select="$endl" />
    </xsl:template>

    <xsl:template name="textInFrame">
        <xsl:param name="text" />
        <xsl:param name="length" />
        <xsl:param name="nesting" />

        <xsl:call-template name="repeat">
            <xsl:with-param name="char" select="$vLine" />
            <xsl:with-param name="length" select="$nesting" />
        </xsl:call-template>

        <xsl:value-of select="$vLine" />

        <xsl:value-of select="$text" />

        <xsl:call-template name="line">
            <xsl:with-param name="char" select="' '" />
            <xsl:with-param name="length" select="$length - string-length($text) - (2 * $nesting)" />
        </xsl:call-template>

        <xsl:value-of select="$vLine" />

        <xsl:call-template name="repeat">
            <xsl:with-param name="char" select="$vLine" />
            <xsl:with-param name="length" select="$nesting" />
        </xsl:call-template>

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