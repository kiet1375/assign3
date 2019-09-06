<?xml version="1.0" encoding="UTF-8"?>

<xsl:stylesheet version="2.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:template match="/">
	<xsl:variable name="idTransform" select="/root/@idTransform"></xsl:variable>
	<xsl:for-each select="//*[@id=$idTransform]"></xsl:for-each>
	<xsl:value-of select= "."/>
</xsl:template>
</xsl:stylesheet>